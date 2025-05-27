<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubInformasi extends Model
{
    use HasFactory;
    
    protected $table = 'sub_informasi';
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'video', 'dokumen'];
}
