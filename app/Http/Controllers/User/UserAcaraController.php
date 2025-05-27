<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use Illuminate\Http\Request;

class UserAcaraController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil acara yang sedang berlangsung dan diikuti oleh user
        $acaras_sedang = Acara::whereIn('id', function($query) use ($user) {
            $query->select('acara_id')
                  ->from('peserta_acara')
                  ->where('user_id', $user->id);
        })
        ->where('tanggal_selesai', '>=', now())  // Acara yang masih berlangsung
        ->orderBy('tanggal_mulai', 'desc')  // Mengurutkan berdasarkan tanggal_mulai
        ->get();

        // Ambil acara yang sudah selesai dan diikuti oleh user
        $acaras_selesai = Acara::whereIn('id', function($query) use ($user) {
            $query->select('acara_id')
                  ->from('peserta_acara')
                  ->where('user_id', $user->id);
        })
        ->where('tanggal_selesai', '<', now())  // Acara yang sudah selesai
        ->orderBy('tanggal_selesai', 'desc')  // Mengurutkan berdasarkan tanggal_selesai
        ->get();

        // Kirim data ke view
        return view('user.acara.index', compact('acaras_sedang', 'acaras_selesai'));
    }

    public function show($id)
    {
        $acara = Acara::findOrFail($id);
    
        return view('user.acara.show', compact('acara'));
    }
    
}

