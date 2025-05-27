<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class VerifyEmail extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $this->user->getKey(),
                'hash' => sha1($this->user->email),
            ]
        );

        return (new MailMessage)
            ->subject('Verifikasi Email Anda')
            ->line('Klik tombol di bawah ini untuk memverifikasi email Anda.')
            ->action('Verifikasi Email', $url);
    }
}
