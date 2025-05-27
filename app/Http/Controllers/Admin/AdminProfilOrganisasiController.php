<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProfilOrganisasiController extends Controller
{
    public function index()
{
    $profil = ProfilOrganisasi::first(); // Ambil satu data pertama

    return view('admin.pages.profil_organisasi.index', compact('profil'));
}

    public function edit()
    {
        $profil = ProfilOrganisasi::first();
        return view('admin.pages.profil_organisasi.edit', compact('profil'));
    }

    public function update(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required',
        'banner' => 'nullable|image|max:2048',
        'bagan_judul' => 'nullable|string|max:255',
        'bagan_gambar' => 'nullable|image|max:2048',
        'visi' => 'nullable',
        'misi' => 'nullable',
    ]);

    // Menyimpan atau mengambil data profil
    $profil = ProfilOrganisasi::firstOrNew();

    // Menghapus banner jika checkbox "Hapus Banner" dicentang
    if ($request->has('hapus_banner') && $request->hapus_banner == 'on') {
        if ($profil->banner) {
            Storage::disk('public')->delete($profil->banner);
            $profil->banner = null;
        }
    } elseif ($request->hasFile('banner')) {
        if ($profil->banner) {
            Storage::disk('public')->delete($profil->banner);
        }
        $profil->banner = $request->file('banner')->store('profil_banner', 'public');
    }

    // Menghapus bagan gambar jika checkbox "Hapus Bagan Organisasi" dicentang
    if ($request->has('hapus_bagan') && $request->hapus_bagan == 'on') {
        if ($profil->bagan_gambar) {
            Storage::disk('public')->delete($profil->bagan_gambar);
            $profil->bagan_gambar = null;
        }
    } elseif ($request->hasFile('bagan_gambar')) {
        if ($profil->bagan_gambar) {
            Storage::disk('public')->delete($profil->bagan_gambar);
        }
        $profil->bagan_gambar = $request->file('bagan_gambar')->store('profil_bagan', 'public');
    }

    // Menyimpan data lain yang diupdate
    $profil->judul = $request->judul;
    $profil->deskripsi = $request->deskripsi;
    $profil->bagan_judul = $request->bagan_judul;
    $profil->visi = $request->visi;
    $profil->misi = $request->misi;

    // Simpan perubahan
    $profil->save();

    return redirect()->route('admin.profil_organisasi.index')->with('success', 'Profil organisasi diperbarui.');
}


public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string',
        'deskripsi' => 'required|string',
        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'bagan_judul' => 'nullable|string',
        'bagan_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'visi' => 'nullable|string',
        'misi' => 'nullable|string',
    ]);

    // Upload gambar jika ada
    $bannerPath = $request->file('banner') ? $request->file('banner')->store('banners', 'public') : null;
    $baganPath = $request->file('bagan_gambar') ? $request->file('bagan_gambar')->store('bagan', 'public') : null;

    ProfilOrganisasi::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'banner' => $bannerPath,
        'bagan_judul' => $request->bagan_judul,
        'bagan_gambar' => $baganPath,
        'visi' => $request->visi,
        'misi' => $request->misi,
    ]);

    return redirect()->route('admin.profil_organisasi.index')->with('success', 'Profil Organisasi berhasil ditambahkan!');
}

}
