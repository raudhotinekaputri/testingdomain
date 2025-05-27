<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanKategori extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_kategoris';

    protected $fillable = [
        'nama',
    ];


    // Model Kategori
public function pelatihans()
{
    return $this->hasMany(Pelatihan::class);
}

}
