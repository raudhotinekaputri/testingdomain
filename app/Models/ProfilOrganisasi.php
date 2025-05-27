<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'banner',
        'bagan_judul',
        'bagan_gambar',
        'visi',
        'misi',
    ];
}
