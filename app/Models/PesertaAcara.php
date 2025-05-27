<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaAcara extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai dengan penamaan konvensi
    protected $table = 'peserta_acara';

    // Kolom yang dapat diisi
    protected $fillable = [
        'acara_id', 'nama', 'whatsapp', 'email', 'alamat', 'user_id',
    ];

    // Relasi ke model Acara
    public function acara()
    {
        return $this->belongsTo(Acara::class, 'acara_id');
    }
}
