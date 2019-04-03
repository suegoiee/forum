<?php

namespace App\Mail;

use App\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class EmailConfirmationEmail extends Mailable
{
    use SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('請認證您的優分析論壇帳號')
            ->markdown('emails.email_confirmation');
    }
}
