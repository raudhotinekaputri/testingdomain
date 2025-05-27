<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;


    protected $fillable = [
        'judul', 'deskripsi', 'nama_pemilik', 'alamat', 
        'whatsapp', 'link_olshop', 'link_sosmed', 
        'kategori', 'user_id','thumbnail'
    ];    
    

    public function fotoProduks()
{
    return $this->hasMany(FotoProduk::class, 'produk_id');
}

public function fotos()
{
    return $this->hasMany(FotoProduk::class, 'produk_id');
}


    public function produk()
{
    return $this->belongsTo(Produk::class, 'produk_id');
}


public function user()
{
    return $this->belongsTo(User::class, 'user_id')->withDefault();
}


    public function getThumbnailUrlAttribute()
{
    return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('images/default-product.jpg');
}

public function kategoriRelasi()
{
    return $this->hasOne(Kategori::class, 'nama_kategori', 'kategori');
}

/**
     * Scope untuk memfilter produk berdasarkan kategori.
     */
    public function scopeFilterByKategori($query, $kategori)
    {
        if ($kategori) {
            return $query->where('kategori', $kategori);
        }

        return $query;
    }

    /**
     * Scope untuk memfilter produk berdasarkan judul.
     */
    public function scopeFilterByJudul($query, $judul)
    {
        if ($judul) {
            return $query->where('judul', 'like', '%' . $judul . '%');
        }

        return $query;
    }

}

