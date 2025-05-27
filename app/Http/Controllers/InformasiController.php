<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Models\SubInformasi;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;


class InformasiController extends Controller
{
    public function index(Request $request)
{
    $informasi = Informasi::all();
    $produks = Produk::all();

    // Buat daftar UMKM unik berdasarkan nama_pemilik
    $umkmList = $produks->unique('nama_pemilik')->values()->map(function ($item) {
        return (object)[
            'nama_pemilik' => $item->nama_pemilik,
            'alamat'       => $item->alamat,
            'judul'        => $item->judul,
            'whatsapp'     => $item->whatsapp,
        ];
    });

    // Hitung jumlah produk per kategori
    $kategoriProduk = DB::table('produks')
        ->select('kategori', DB::raw('count(*) as total'))
        ->groupBy('kategori')
        ->get();

    // Filter Sub Informasi berdasarkan pencarian
    $search = $request->input('search');
    $subInformasiList = SubInformasi::when($search, function ($query) use ($search) {
        return $query->where('judul', 'like', "%$search%")
                     ->orWhere('deskripsi', 'like', "%$search%");
    })->get();

    return view('informasi.index', compact(
        'informasi',
        'produks',
        'umkmList',
        'kategoriProduk',
        'subInformasiList',
        'search'
    ));
}

    public function show($id)
{
    $informasi = Informasi::findOrFail($id);
    return view('informasi.show', compact('informasi'));
}

}

