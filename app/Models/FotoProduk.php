<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'foto'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }


    public function show($id)
{
    $produk = Produk::with('fotoProduks')->findOrFail($id);
    return view('produk.show', compact('produk'));
}

}
