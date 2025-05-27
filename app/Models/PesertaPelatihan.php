<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaPelatihan extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang sesuai
    protected $table = 'pelatihan_pesertas';

    protected $fillable = [
        'user_id', 
        'pelatihan_id', 
        'nama', 
        'nama_usaha',
        'whatsapp', 
        'email',
        'alamat',
        'file_sertifikat',
    ];    

    // Relasi ke Pelatihan
    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }


}
