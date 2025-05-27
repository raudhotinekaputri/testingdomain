<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriAcara extends Model
{
    protected $table = 'kategori_acaras';
    protected $fillable = ['nama'];

    public function acaras()
    {
        return $this->hasMany(Acara::class, 'kategori_id');
    }
}
