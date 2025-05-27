<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Bus\Queueable;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password Akunmu')
            ->greeting('Halo!')
            ->line('Kamu menerima email ini karena kami menerima permintaan reset password untuk akunmu.')
            ->action('Reset Password', $url)
            ->line('Tautan ini hanya berlaku selama 60 menit.')
            ->line('Jika kamu tidak merasa meminta, kamu bisa abaikan email ini.');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
