<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriUsaha;
use Illuminate\Http\Request;

class AdminKategoriUsahaController extends Controller
{
    public function index()
    {
        $kategoris = KategoriUsaha::latest()->paginate(10);
        // Menampilkan view dengan membawa data kategori
        return view('admin.pages.kategori_usaha.index', compact('kategoris'));
    }

    public function create()
    {
        // Menampilkan form untuk menambahkan kategori baru
        return view('admin.pages.kategori_usaha.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Menyimpan data kategori baru ke database
        KategoriUsaha::create($request->only('nama'));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kategori-usaha.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($kategori_usaha)
{
    $kategori_usaha = KategoriUsaha::findOrFail($kategori_usaha);
    return view('admin.pages.kategori_usaha.edit', compact('kategori_usaha'));
}


    public function update(Request $request, KategoriUsaha $kategori)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Memperbarui data kategori yang sudah ada
        $kategori->update($request->only('nama'));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kategori-usaha.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
{
    $kategori = KategoriUsaha::findOrFail($id);
    $kategori->delete();

    return redirect()->route('admin.kategori-usaha.index')
                     ->with('success', 'Kategori berhasil dihapus!');
}

}
