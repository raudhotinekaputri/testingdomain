<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Acara extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'foto','tanggal_mulai', 'tanggal_selesai','kategori_id','bisa_daftar'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function kategori()
{
    return $this->belongsTo(KategoriAcara::class, 'kategori_id');
}

// Tentukan relasi dengan model PesertaAcara (relasi banyak ke banyak)
public function pesertaAcara()
{
    return $this->hasMany(PesertaAcara::class, 'acara_id');
}

// Tentukan relasi dengan User melalui PesertaAcara
public function users()
{
    return $this->belongsToMany(User::class, 'peserta_acara', 'acara_id', 'user_id');
}


}


