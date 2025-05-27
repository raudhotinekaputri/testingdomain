<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PelatihanKategori;


class Pelatihan extends Model
{
    use HasFactory;

    protected $table = 'pelatihans'; 

    protected $fillable = [
        'judul', 'deskripsi', 'kategori_id', 'tanggal_mulai', 'tanggal_selesai', 
        'jam', 'tipe', 'lokasi', 'penyelenggara', 'foto', 'khusus_umkm_patikraja'
    ];
    
    public function kategori()
{
    return $this->belongsTo(PelatihanKategori::class, 'kategori_id');
}

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_pelatihan_daftars');
    }

    public function peserta()
    {
        return $this->hasMany(PesertaPelatihan::class, 'pelatihan_id');
    }

}
