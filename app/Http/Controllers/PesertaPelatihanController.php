<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaPelatihan;
use App\Models\Pelatihan;
use Illuminate\Support\Facades\Auth;

class PesertaPelatihanController extends Controller
{
    public function create($pelatihan_id)
{
    // Cek apakah pelatihan dengan ID yang diminta ada
    $pelatihan = Pelatihan::findOrFail($pelatihan_id);

    // Cek apakah user sudah login (jika diperlukan untuk prefill nama/email/whatsapp)
    $user = auth()->check() ? auth()->user() : null;

    // Kirim data pelatihan dan user (jika ada) ke view
    return view('pelatihan.daftar', compact('pelatihan', 'user'));
}

public function store(Request $request)
{
    // Validasi input form
    $request->validate([
        'pelatihan_id' => 'required|exists:pelatihans,id',  // Menggunakan nama tabel yang benar
        'nama' => 'required|string',
        'whatsapp' => 'required|string',
        'email' => 'required|email',
        'alamat' => 'required|string',  // Validasi alamat
        'nama_usaha' => 'nullable|string|max:255', // Validasi nama_usaha (nullable artinya boleh kosong)
    ]);

    // Pastikan pelatihan_id ada di database
    $pelatihan = Pelatihan::findOrFail($request->pelatihan_id);  // Menggunakan findOrFail untuk menghindari error jika pelatihan_id tidak valid

    // Simpan data peserta pelatihan
    PesertaPelatihan::create([
        'pelatihan_id' => $request->pelatihan_id,
        'nama' => $request->nama,
        'whatsapp' => $request->whatsapp,
        'email' => $request->email,
        'alamat' => $request->alamat,  // Menyimpan alamat
        'nama_usaha' => $request->nama_usaha, // Menyimpan nama usaha (jika ada)
        'user_id' => Auth::check() ? Auth::id() : null,  // Menyimpan ID user jika login
    ]);

    // Redirect setelah berhasil mendaftar dan tampilkan pesan sukses
    return redirect()->route('peserta.pendaftaran.sukses')->with('success', 'Pendaftaran berhasil! Anda akan menerima informasi lebih lanjut melalui email atau WhatsApp.');
}


// Menambahkan fungsi sukses untuk halaman konfirmasi
public function sukses()
{
    return view('pelatihan.sukses');
}

}
