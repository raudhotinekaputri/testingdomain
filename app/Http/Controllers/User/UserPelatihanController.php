<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pelatihan;
use App\Models\PesertaPelatihan;
use Illuminate\Http\Request;
use App\Models\PelatihanKategori;
use Illuminate\Support\Facades\DB;



class UserPelatihanController extends Controller
{
    // Menampilkan semua pelatihan publik (yang bukan khusus Patikraja)
    public function index()
    {
        $user = auth()->user();
        // Ambil kategori dari tabel pelatihan_kategoris
        $kategoriList = PelatihanKategori::pluck('nama', 'id')->toArray();
        
        $pelatihanIds = \DB::table('pelatihan_pesertas')
            ->where('user_id', $user->id)
            ->pluck('pelatihan_id');
        
        // Ambil semua pelatihan yang user daftar
        $pelatihanSaya = Pelatihan::whereIn('id', $pelatihanIds)->get();
        
        $today = now();
        
        // Filter pelatihan sedang berlangsung
        $pelatihan_sedang = Pelatihan::whereDate('tanggal_mulai', '<=', $today)
    ->whereDate('tanggal_selesai', '>=', $today)
    ->get();
        
        // Filter pelatihan selesai
        $pelatihan_selesai = $pelatihanSaya->filter(function ($p) use ($today) {
            return $p->tanggal_selesai < $today;
        });
    
        // Ambil data sertifikat yang sudah di-upload oleh admin
        foreach ($pelatihan_selesai as $pelatihan) {
            $pelatihan->sertifikat = PesertaPelatihan::where('pelatihan_id', $pelatihan->id)
                ->where('user_id', $user->id)
                ->first()->file_sertifikat ?? null;
        }
        
        return view('user.pelatihan.index', compact('pelatihan_sedang', 'pelatihan_selesai', 'kategoriList'));
    }    
    
    
    // Menampilkan detail pelatihan
    public function show($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        
        // Ambil data sertifikat yang sudah di-upload admin
        $sertifikat = PesertaPelatihan::where('pelatihan_id', $pelatihan->id)
            ->where('user_id', auth()->id())
            ->first()
            ->file_sertifikat ?? null;
            
        return view('user.pelatihan.show', compact('pelatihan', 'sertifikat'));
    }
    

    // Menampilkan form pendaftaran peserta
    public function daftar($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        return view('pelatihan.daftar', compact('pelatihan'));
    }

    // Menyimpan data pendaftaran peserta
    public function daftarStore(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'no_wa'  => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $pelatihan = Pelatihan::findOrFail($id);

        // Cek apakah email sudah terdaftar di pelatihan ini
        $sudahTerdaftar = PesertaPelatihan::where('email', $request->email)
            ->where('pelatihan_id', $pelatihan->id)
            ->exists();

        if ($sudahTerdaftar) {
            return redirect()->back()->with('warning', 'Anda sudah mendaftar pelatihan ini.');
        }

        PesertaPelatihan::create([
            'pelatihan_id' => $pelatihan->id,
            'nama'         => $request->nama,
            'email'        => $request->email,
            'no_wa'        => $request->no_wa,
            'alamat'       => $request->alamat,
        ]);

        return redirect()->route('pelatihan.show', $pelatihan->id)->with('success', 'Pendaftaran berhasil!');
    }
}
