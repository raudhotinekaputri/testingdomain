<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'judul', 'deskripsi', 'nama_pemilik', 'alamat', 'whatsapp',
        'link_olshop', 'link_sosmed', 'thumbnail', 'user_id', 'kategori'
    ];  

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fotos()
    {
        return $this->hasMany(FotoProduk::class, 'produk_id');
    }
}
