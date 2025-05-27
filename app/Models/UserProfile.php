<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles'; // Sesuai nama tabel di database

    protected $fillable = [
        'user_id',
        'nama',
        'no_whatsapp',
        'alamat',
        'nama_usaha',
        'alamat_usaha',
        'kategori_usaha',
        'nomor_izin_usaha',
        'nomor_whatsapp_usaha',
        'link_olshop_1',
        'link_olshop_2',
        'deskripsi_usaha',
        'profile_picture',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategoriUsaha()
{
    return $this->belongsToMany(KategoriUsaha::class);
}


public function updateProfileStatus()
{
    if ($this->nama) {
        $this->user->profile_completed = 1;
        $this->user->save();
    }
}

}


