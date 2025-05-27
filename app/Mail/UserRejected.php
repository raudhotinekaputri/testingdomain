<?php

// app/Mail/UserRejected.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Akun Anda Ditolak')
                    ->view('emails.user_rejected'); // Gunakan view yang akan kamu buat
    }
}
