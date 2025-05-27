<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AccountApproved extends Notification
{
    public function __construct()
    {
        // Fitur approval dinonaktifkan
    }

    public function via($notifiable)
    {
        return []; // Tidak mengirim notifikasi apa pun
    }

    /*
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Akun Anda Telah Disetujui')
            ->greeting('Selamat!')
            ->line('Akun Anda telah berhasil disetujui oleh admin.')
            ->line('Anda sekarang sudah dapat masuk dan menggunakan semua fitur kami.')
            ->action('Masuk ke Website', url('/login'))
            ->line('Terima kasih telah bergabung dengan kami!');
    }
    */
}
