<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, AuthenticableTrait;

    protected $fillable = [
        'email',
        'password',
        // 'approved', // dikomentari karena fitur approval dinonaktifkan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    // Fitur approval dinonaktifkan
    /*
    public function isApproved()
    {
        return $this->approved === 'approved';
    }
    */

    public function pelatihanDaftar()
    {
        return $this->belongsToMany(Pelatihan::class, 'pelatihan_pesertas');
    }

    public function pelatihans()
    {
        return $this->belongsToMany(Pelatihan::class)->withTimestamps();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmail($this));
    }

    public function isProfileCompleted()
    {
        if (!$this->profile) return false;
    
        return $this->profile->nama && $this->profile->no_whatsapp;
    }

public function sendPasswordResetNotification($token)
{
    $this->notify(new ResetPasswordNotification($token));
}

public function pelatihanSelesai()
{
    return $this->hasMany(PesertaPelatihan::class)->whereHas('pelatihan', function ($q) {
        $q->whereDate('tanggal_selesai', '<=', now());
    });
}
}
