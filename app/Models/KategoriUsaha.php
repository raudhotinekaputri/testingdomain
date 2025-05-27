<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriUsaha extends Model
{
    protected $table = 'kategori_usahas';
    protected $fillable = ['nama'];

    public function userProfiles()
    {
        return $this->belongsToMany(UserProfile::class, 'kategori_usaha_user_profile');
    }
}

