<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Storage;

class AdminInformasiController extends Controller {
    public function index()
{
    $informasi = Informasi::first();
    return view('admin.pages.informasi.index', compact('informasi'));
}

public function edit($id)
{
    $informasi = Informasi::findOrFail($id);
    return view('admin.pages.informasi.edit', compact('informasi'));
}

public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'dokumen' => 'nullable|file|max:5120',
            'video' => 'nullable|file|mimes:mp4,avi|max:10240',
        ]);

        $data = $request->all();

        // Cek apakah ada file gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($informasi->gambar) {
                Storage::disk('public')->delete($informasi->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('informasi/gambar', 'public');
        }

        // Cek apakah ada file dokumen baru
        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama jika ada
            if ($informasi->dokumen) {
                Storage::disk('public')->delete($informasi->dokumen);
            }
            // Simpan dokumen baru
            $data['dokumen'] = $request->file('dokumen')->store('informasi/dokumen', 'public');
        }

        // Cek apakah ada file video baru
        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($informasi->video) {
                Storage::disk('public')->delete($informasi->video);
            }
            // Simpan video baru
            $data['video'] = $request->file('video')->store('informasi/video', 'public');
        }

        // Hapus gambar, dokumen, atau video jika tombol hapus ditekan
        if ($request->has('hapus_gambar') && $request->hapus_gambar == 'hapus') {
            if ($informasi->gambar) {
                Storage::disk('public')->delete($informasi->gambar);
            }
            $data['gambar'] = null;
        }

        if ($request->has('hapus_dokumen') && $request->hapus_dokumen == 'hapus') {
            if ($informasi->dokumen) {
                Storage::disk('public')->delete($informasi->dokumen);
            }
            $data['dokumen'] = null;
        }

        if ($request->has('hapus_video') && $request->hapus_video == 'hapus') {
            if ($informasi->video) {
                Storage::disk('public')->delete($informasi->video);
            }
            $data['video'] = null;
        }

        // Update informasi
        $informasi->update($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Acara berhasil diperbarui!');

    }

}
