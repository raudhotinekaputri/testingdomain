<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriAcara;
use Illuminate\Http\Request;

class AdminKategoriAcaraController extends Controller
{
    public function index()
    {
        $kategoriAcaras = KategoriAcara::latest()->paginate(10);
        return view('admin.pages.kategori_acara.index', compact('kategoriAcaras'));
    }

    public function create()
    {
        return view('admin.pages.kategori_acara.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        KategoriAcara::create($request->only('nama'));

        return redirect()->route('admin.kategori-acara.index')->with('success', 'Kategori acara berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategoriAcara = KategoriAcara::findOrFail($id);
        return view('admin.pages.kategori_acara.edit', compact('kategoriAcara'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $kategoriAcara = KategoriAcara::findOrFail($id);
        $kategoriAcara->update($request->only('nama'));

        return redirect()->route('admin.kategori-acara.index')->with('success', 'Kategori acara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriAcara = KategoriAcara::findOrFail($id);
        $kategoriAcara->delete();

        return redirect()->route('admin.kategori-acara.index')->with('success', 'Kategori acara berhasil dihapus.');
    }
}
