<?php

namespace App\Notifications;

use App\User;
use App\Models\Reply;
use App\Mail\NewReplyEmail;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

final class NewReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var \App\Models\Reply
     */
    public $reply;

    /**
     * @var \App\Models\Subscription
     */
    public $subscription;

    public function __construct(Reply $reply, Subscription $subscription)
    {
        $this->reply = $reply;
        $this->subscription = $subscription;
    }

    public function via(User $user)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $user)
    {
        /*return (new NewReplyEmail($this->reply, $this->subscription))
            ->to($user->emailAddress(), $user->name());*/
        return (new MailMessage)
        ->subject(env('APP_NAME'). "Re:". $this->reply->replyAble()->subject())
        ->from(env('APP_EMAIL','no-reply@localhost'),env('APP_SYSTEM_NAME','Service'))
        ->line($this->reply->author()->name().'在這篇文章底下留言.')
        ->line(str_limit(strip_tags($this->reply->body), 100))
        ->action('前往文章', route('thread', $this->reply->replyAble()->slug()))
        ->line('您會收到此信係因您有追蹤此篇文章，如要取消請')
        ->line([取消追蹤](route('subscriptions.unsubscribe', $subscription->uuid()->toString())))
        ->line('此文章');
    }

    public function toArray(User $user)
    {
        return [
            //
        ];
    }
}
