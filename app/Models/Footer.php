<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footer';
    protected $fillable = [
        'tentang_umkm',
        'alamat',
        'email',
        'telepon',
        'facebook',
        'twitter',
        'instagram',
        'linkedin'
    ];
}
