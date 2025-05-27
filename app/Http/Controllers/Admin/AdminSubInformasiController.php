<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubInformasi;
use Illuminate\Support\Facades\Storage;

class AdminSubInformasiController extends Controller
{
    public function index()
    {
        $subInformasis = SubInformasi::paginate(10);
        return view('admin.pages.sub_informasi.index', compact('subInformasis'));
    }

    public function create()
    {
        return view('admin.pages.sub_informasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|file|mimes:mp4|max:10240',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $subInformasi = new SubInformasi();
        $subInformasi->judul = $request->judul;
        $subInformasi->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $subInformasi->gambar = $request->file('gambar')->store('sub_informasi', 'public');
        }

        if ($request->hasFile('video')) {
            $subInformasi->video = $request->file('video')->store('sub_informasi', 'public');
        }

        if ($request->hasFile('dokumen')) {
            $subInformasi->dokumen = $request->file('dokumen')->store('sub_informasi', 'public');
        }

        $subInformasi->save();

        return redirect()->route('admin.sub_informasi.index')->with('success', 'Sub Informasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $subInformasi = SubInformasi::findOrFail($id);
        return view('admin.pages.sub_informasi.edit', compact('subInformasi'));
    }

    public function update(Request $request, $id)
{
    $subInformasi = SubInformasi::findOrFail($id);

    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'video' => 'nullable|file|mimes:mp4|max:10240',
        'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
    ]);

    $subInformasi->judul = $request->judul;
    $subInformasi->deskripsi = $request->deskripsi;

    // Cek jika gambar ingin dihapus
    if ($request->has('hapus_gambar') && $subInformasi->gambar) {
        Storage::disk('public')->delete($subInformasi->gambar); // Menghapus gambar yang lama
        $subInformasi->gambar = null; // Set gambar jadi null
    }

    // Cek jika video ingin dihapus
    if ($request->has('hapus_video') && $subInformasi->video) {
        Storage::disk('public')->delete($subInformasi->video); // Menghapus video yang lama
        $subInformasi->video = null; // Set video jadi null
    }

    // Cek jika dokumen ingin dihapus
    if ($request->has('hapus_dokumen') && $subInformasi->dokumen) {
        Storage::disk('public')->delete($subInformasi->dokumen); // Menghapus dokumen yang lama
        $subInformasi->dokumen = null; // Set dokumen jadi null
    }

    // Upload file baru jika ada
    if ($request->hasFile('gambar')) {
        $subInformasi->gambar = $request->file('gambar')->store('sub_informasi', 'public');
    }

    if ($request->hasFile('video')) {
        $subInformasi->video = $request->file('video')->store('sub_informasi', 'public');
    }

    if ($request->hasFile('dokumen')) {
        $subInformasi->dokumen = $request->file('dokumen')->store('sub_informasi', 'public');
    }

    $subInformasi->save();

    // Notifikasi sukses
    return redirect()->route('admin.sub_informasi.index')
                     ->with('success', 'Sub Informasi berhasil diperbarui!');
}


    public function destroy($id)
    {
        $subInformasi = SubInformasi::findOrFail($id);
        $subInformasi->delete();
        return redirect()->route('admin.sub_informasi.index')->with('success', 'Sub Informasi berhasil dihapus.');
    }
    
}
