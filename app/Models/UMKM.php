<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    use HasFactory;

    protected $table = 'umkms';

    protected $fillable = [
        'judul',
        'deskripsi',
        'banner_1',
        'banner_2',
        'banner_3'
    ];
}
