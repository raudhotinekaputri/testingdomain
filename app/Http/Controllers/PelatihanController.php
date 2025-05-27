<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\PelatihanKategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PesertaPelatihan;

class PelatihanController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->toDateString();

        // Base query
        $pelatihans = Pelatihan::with('kategori');

        // Filter: Kategori
        if ($request->filled('kategori')) {
            $pelatihans->where('kategori_id', $request->kategori);
        }

        // Filter Jadwal
        if ($request->filled('jadwal')) {
            $pelatihans->whereDate('tanggal_mulai', $request->jadwal);
        }

        // Filter: Tipe
        if ($request->filled('tipe')) {
            $pelatihans->where('tipe', $request->tipe);
        }

        // Filter: Status
        if ($request->filled('status')) {
            if ($request->status == 'upcoming') {
                $pelatihans->whereDate('tanggal_mulai', '>', $today);
            } elseif ($request->status == 'soon') {
                $pelatihans->whereDate('tanggal_mulai', '=', $today);
            } elseif ($request->status == 'finished') {
                $pelatihans->whereDate('tanggal_mulai', '<', $today);
            }
        }

        // Ambil data dan tandai jenis
        $semuaPelatihan = $pelatihans->get()->map(function ($item) {
            $item->jenis = 'umum';
            return $item;
        });

        // Daftar kategori
        $kategoriList = PelatihanKategori::pluck('nama', 'id');

        return view('pelatihan.index', compact('semuaPelatihan', 'kategoriList'));
    }

    public function show($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        // Kalau pelatihan khusus & belum login, arahkan ke login
        if ($pelatihan->khusus_umkm_patikraja && !auth()->check()) {
            return redirect()->route('user.login', ['redirect' => route('pelatihans.show', $id)])
                ->with('error', 'Silakan login untuk mengakses pelatihan ini.');
        }

        // Cek apakah user sudah daftar
        $sudahDaftar = false;

        if (auth()->check()) {
            $sudahDaftar = auth()->user()->pelatihanDaftar()
                ->where('pelatihan_id', $pelatihan->id)
                ->exists();
        }

        return view('pelatihan.show', compact('pelatihan', 'sudahDaftar'));
    }

    public function cetakSertifikat($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $user = auth()->user(); // tambahkan baris ini
        $peserta = $pelatihan->peserta()->where('user_id', $user->id)->first();
    
        return Pdf::loadView('pelatihan.sertifikat', compact('pelatihan', 'peserta', 'user'))
                  ->stream('sertifikat.pdf');
    }
    
    
}
