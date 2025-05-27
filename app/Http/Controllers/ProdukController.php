<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


class ProdukController extends Controller
{
    public function index(Request $request)
{
    $query = Produk::with('fotoProduks'); // Tambahkan eager loading

    if ($request->has('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
              ->orWhere('nama_pemilik', 'like', '%' . $request->search . '%');
    }

    $produks = $query->paginate(12); // Bisa disesuaikan jumlah per halaman

    return view('produk.index', compact('produks'));
}

public function boot(): void
{
    Paginator::useBootstrap();
}

public function show($id)
{
    $produk = Produk::with('fotoProduks')->findOrFail($id);
    return view('produk.show', compact('produk'));
}

}
