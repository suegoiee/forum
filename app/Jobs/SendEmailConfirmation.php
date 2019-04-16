<?php

namespace App\Jobs;

use App\User;
use App\Mail\EmailConfirmationEmail;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;

final class SendEmailConfirmation
{
    use SerializesModels;

    /**
     * @var \App\User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(Mailer $mailer)
    {
        $mailer->to($this->user->emailAddress())
            ->send(new EmailConfirmationEmail($this->user));
            
        return (new MailMessage)
        ->subject('請認證您的優分析論壇帳號')
        ->from(env('APP_EMAIL','no-reply@localhost'),env('APP_SYSTEM_NAME','Service'))
        ->line('我們需要認證您的信箱來開通您的帳號，請點選下方按鈕完成認證:')
        ->action('認證信箱', route('email.confirm').'?email='.urlencode($user->emailAddress()).'&code='. $user->confirmationCode())
        ->line('再次感謝您對'."<a href=".route('home').">優分析論壇</a>".'的支持');
    }
}
