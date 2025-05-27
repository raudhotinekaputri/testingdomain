<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi'; // Pastikan ini ada

    protected $fillable = ['judul', 'deskripsi', 'gambar', 'video', 'dokumen'];
}
