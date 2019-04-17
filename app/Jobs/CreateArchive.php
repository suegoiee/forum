<?php

namespace App\Jobs;

use App\User;
use Ramsey\Uuid\Uuid;
use App\Models\Archive;
use App\Models\Subscription;
use App\Http\Requests\ArchiveRequest;

final class CreateArchive
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

    public static function fromRequest(ArchiveRequest $request): self
    {
        return new static(
            $request->subject(),
            $request->body(),
            $request->author(),
            $request->tags()
        );
    }

    public function handle(): Archive
    {
        $archive = new Archive([
            'subject' => $this->subject,
            'body' => $this->body,
            'slug' => urlencode($this->subject),
        ]);
        $archive->authoredBy($this->author);
        $archive->syncTags($this->tags);
        $archive->save();

        // Subscribe author to the Archive.
        $subscription = new Subscription();
        $subscription->uuid = Uuid::uuid4()->toString();
        $subscription->userRelation()->associate($this->author);
        $subscription->subscriptionAbleRelation()->associate($archive);

        $archive->subscriptionsRelation()->save($subscription);

        return $archive;
    }
}
