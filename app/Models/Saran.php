<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    protected $table = 'sarans';

    protected $fillable = ['email', 'isi', 'is_read'];

    public function showFooterData()
{
    // Ambil 5 saran terbaru
    $saranTerbaru = Saran::orderBy('created_at', 'desc')->take(5)->get();

    // Pass data saran ke view
    return view('yourview', compact('saranTerbaru'));
}

}
