<?php

namespace App\Http\Controllers;

use App\Models\PesertaAcara;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaAcaraController extends Controller
{
    public function create($acara_id)
    {
        // Mengambil acara berdasarkan ID yang diberikan
        $acara = Acara::findOrFail($acara_id);

        // Jika user sudah login, prefill nama, email, whatsapp
        $user = auth()->check() ? auth()->user() : null;

        // Mengirimkan data acara dan user (jika ada) ke tampilan
        return view('acaras.daftar', compact('acara', 'user'));
    }

    public function store(Request $request)
    {

        // Validasi input form
        $request->validate([
            'acara_id' => 'required|exists:acaras,id',  
            'nama' => 'required|string',
            'whatsapp' => 'required|string',
            'email' => 'required|email',
            'alamat' => 'required|string',  
        ]);
    
        $acara = Acara::findOrFail($request->acara_id); 
    
        // Simpan data peserta acara
        $peserta = PesertaAcara::create([
            'acara_id' => $request->acara_id,
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'user_id' => Auth::check() ? Auth::id() : null,  // Menyimpan ID user jika login
        ]);
    
        // Redirect setelah berhasil mendaftar dan tampilkan pesan sukses
        return redirect()->route('acaras.bukti', ['id' => $peserta->id])->with('success', 'Pendaftaran berhasil!');

    }
    
    
    public function bukti($id)
    {
        // Mengambil data peserta berdasarkan ID
        $peserta = PesertaAcara::findOrFail($id);
        $acara = Acara::findOrFail($peserta->acara_id);

        // Menampilkan halaman bukti pendaftaran
        return view('acaras.bukti', compact('peserta', 'acara'));
    }
}
