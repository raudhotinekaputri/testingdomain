<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminUMKMController extends Controller
{
    public function index()
    {
        $umkms = UMKM::all();
        return view('admin.pages.umkm.index', compact('umkms'));
    }

    public function create()
    {
        return view('admin.pages.umkm.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'banner_1'  => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'banner_2'  => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'banner_3'  => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable'
        ]);

        // Upload banner jika ada
        if ($request->hasFile('banner_1')) {
            $data['banner_1'] = $request->file('banner_1')->store('banners', 'public');
        }
        if ($request->hasFile('banner_2')) {
            $data['banner_2'] = $request->file('banner_2')->store('banners', 'public');
        }
        if ($request->hasFile('banner_3')) {
            $data['banner_3'] = $request->file('banner_3')->store('banners', 'public');
        }

        UMKM::create($data);
        return redirect()->route('admin.umkms.index')->with('success', 'UMKM berhasil ditambahkan!');
    }

    public function edit(UMKM $umkm)
    {
        return view('admin.pages.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $umkm = UMKM::findOrFail($id);
    
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'banner_1' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'banner_2' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'banner_3' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        ]);
    
        $umkm->judul = $request->judul;
        $umkm->deskripsi = $request->deskripsi;
    
        // Menghapus banner jika tombol hapus diklik
        if ($request->has('hapus_banner_1') && $umkm->banner_1) {
            Storage::delete('public/' . $umkm->banner_1);
            $umkm->banner_1 = null;
        }
        if ($request->has('hapus_banner_2') && $umkm->banner_2) {
            Storage::delete('public/' . $umkm->banner_2);
            $umkm->banner_2 = null;
        }
        if ($request->has('hapus_banner_3') && $umkm->banner_3) {
            Storage::delete('public/' . $umkm->banner_3);
            $umkm->banner_3 = null;
        }
    
        // Upload banner baru jika ada
        if ($request->hasFile('banner_1')) {
            $umkm->banner_1 = $request->file('banner_1')->store('umkm_banners', 'public');
        }
        if ($request->hasFile('banner_2')) {
            $umkm->banner_2 = $request->file('banner_2')->store('umkm_banners', 'public');
        }
        if ($request->hasFile('banner_3')) {
            $umkm->banner_3 = $request->file('banner_3')->store('umkm_banners', 'public');
        }
    
        $umkm->save();
    
        return redirect()->route('admin.umkms.index')->with('success', 'UMKM berhasil diperbarui!');
    }
    
    public function destroy(UMKM $umkm)
    {
        $umkm->delete();
        return redirect()->route('admin.umkms.index')->with('success', 'UMKM berhasil dihapus!');
    }
}
