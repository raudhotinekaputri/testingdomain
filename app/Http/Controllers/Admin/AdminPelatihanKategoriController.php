<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PelatihanKategori;
use Illuminate\Http\Request;

class AdminPelatihanKategoriController extends Controller
{
    public function index()
    {
        $kategoris = PelatihanKategori::latest()->paginate(10);
        return view('admin.pages.pelatihan-kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.pages.pelatihan-kategoris.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        PelatihanKategori::create($request->all());
        return redirect()->route('admin.pelatihan-kategoris.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(PelatihanKategori $pelatihan_kategori)
    {
        return view('admin.pages.pelatihan-kategoris.edit', compact('pelatihan_kategori'));
    }

    public function update(Request $request, PelatihanKategori $pelatihan_kategori)
    {
        $request->validate(['nama' => 'required']);
        $pelatihan_kategori->update($request->all());
        return redirect()->route('admin.pelatihan-kategoris.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(PelatihanKategori $pelatihan_kategori)
    {
        $pelatihan_kategori->delete();
        return redirect()->route('admin.pelatihan-kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}
