<?php

namespace App\Jobs;

use App\User;
use App\Mail\EmailConfirmationEmail;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;

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
    }
}
