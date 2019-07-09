<?php

namespace App\Jobs;

use App\User;
use Ramsey\Uuid\Uuid;
use App\Models\Thread;
use App\Models\Subscription;
use App\Http\Requests\ThreadRequest;

final class CreateThread
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @var \App\User
     */
    private $author;

    /**
     * @var array
     */
    private $tags;

    public function __construct(string $subject, string $body, User $author, array $tags = [])
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->author = $author;
        $this->tags = $tags;
    }

    public static function fromRequest(ThreadRequest $request): self
    {
        return new static(
            $request->subject(),
            $request->body(),
            $request->author(),
            $request->tags()
        );
    }

    public function handle(): Thread
    {
        $thread = new Thread([
            'subject' => $this->subject,
            'body' => $this->body,
            'slug' => $this->subject,
        ]);
        $thread->authoredBy($this->author);
        $thread->syncTags($this->tags);
        $thread->save();

        // Subscribe author to the thread.
        $subscription = new Subscription();
        $subscription->uuid = Uuid::uuid4()->toString();
        $subscription->userRelation()->associate($this->author);
        $subscription->subscriptionAbleRelation()->associate($thread);

        $thread->subscriptionsRelation()->save($subscription);

        return $thread;
    }
}
