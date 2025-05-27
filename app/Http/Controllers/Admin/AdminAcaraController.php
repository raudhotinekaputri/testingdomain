<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acara;
use App\Models\KategoriAcara;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;


class AdminAcaraController extends Controller
{
    /**
     * Tampilkan daftar acara.
     */
    public function index()
    {
        
        $kategoriAcaras = KategoriAcara::latest()->get();
        $acaras = Acara::with('kategori')->latest()->paginate(10);
        return view('admin.pages.acara.index', compact('acaras'));
    }

    /**
     * Form tambah acara baru.
     */
    public function create()
{
    $kategoriList = KategoriAcara::all(); 
    return view('admin.pages.acara.create', compact('kategoriList'));
}
    /**
     * Simpan acara baru.
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required',
        'foto' => 'nullable|image|max:2048',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date',
        'kategori_id' => 'required|exists:kategori_acaras,id',
        'bisa_daftar' => 'required|boolean',
    ]);
    

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('acara', 'public');
    }

    Acara::create($data);

    return redirect()->route('admin.acaras.index')->with('success', 'Acara berhasil ditambahkan!');
}
    /**
     * Edit acara.
     */
    public function edit($id)
    {
        $acara = Acara::findOrFail($id);
        $kategoriList = KategoriAcara::all(); // Juga perlu ini di edit
        return view('admin.pages.acara.edit', compact('acara', 'kategoriList'));
    }

    /**
     * Update acara.
     */
    public function update(Request $request, Acara $acara)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kategori_id' => 'required|exists:kategori_acaras,id',
            'bisa_daftar' => 'required|boolean',
        ]);
    
        // Ambil data dari request
        $data = $request->all();
    
        // Mengecek jika ada gambar baru yang diupload
        if ($request->hasFile('foto')) {
            // Jika ada gambar lama, hapus gambar lama dari storage
            if ($acara->foto) {
                Storage::disk('public')->delete($acara->foto);
            }
            // Simpan gambar baru
            $data['foto'] = $request->file('foto')->store('acara', 'public');
        }
    
        // Mengecek jika tombol hapus gambar ditekan
        if ($request->has('hapus_foto') && $request->hapus_foto == 'hapus') {
            // Hapus gambar lama jika ada
            if ($acara->foto) {
                Storage::disk('public')->delete($acara->foto);
            }
            $data['foto'] = null; // Set foto menjadi null
        }
    
        // Update data acara
        $acara->update($data);
    
        return redirect()->route('admin.acaras.edit', $acara->id)->with('success', 'Acara berhasil diperbarui!');
    }
    
    /**
     * Hapus acara.
     */
    public function destroy(Acara $acara)
    {
        $acara->delete();
        return redirect()->route('admin.acaras.index')->with('success', 'Acara berhasil dihapus!');
    }

    public function show($id)
{
    $acara = Acara::findOrFail($id);
    return view('admin.pages.acara.show', compact('acara')); 
}

}
