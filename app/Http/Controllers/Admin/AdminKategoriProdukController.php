<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminKategoriProdukController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('admin.pages.kategori-produks.index', compact('kategoris'));
    }

    public function create()
    {
        return redirect()->route('admin.kategori-produks.index')->with('success', 'Kategori berhasil ditambahkan');

    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required']);
        Kategori::create($request->all());
        return redirect()->route('admin.kategori-produks.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
{
    $kategori = Kategori::findOrFail($id);
    return view('admin.pages.kategori-produks.edit', compact('kategori'));
}


    public function update(Request $request, Kategori $kategori)
{
    $kategori->update($request->all());
    return redirect()->route('admin.kategori-produks.index')->with('success', 'Kategori berhasil diperbarui');
}

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori-produks.index')->with('success', 'Kategori berhasil dihapus');
    }
}
