<?php

// app/Mail/UserApproved.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // Komentar bagian pengiriman email approval
        /*
        return $this->view('emails.user_approved')
                    ->with(['user' => $this->user]);
        */

        // Jika tetap ingin build() mengembalikan sesuatu agar tidak error:
        return $this->view('emails.blank'); // atau view dummy kosong
    }
}
