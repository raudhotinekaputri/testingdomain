<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\PelatihanKategori;
use Illuminate\Support\Facades\Storage;
use App\Models\PesertaPelatihan;

class AdminPelatihanController extends Controller
{
    // Tampilkan daftar pelatihan
    public function index()
{
    $pelatihans = Pelatihan::with('kategori')->paginate(10);
    return view('admin.pages.pelatihan.index', compact('pelatihans'));
}


    // Form tambah pelatihan baru
    public function create()
{
    $kategoriPelatihan = PelatihanKategori::all();
    return view('admin.pages.pelatihan.create', compact('kategoriPelatihan'));
}

    // Simpan data pelatihan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) < strtotime($request->tanggal_mulai)) {
                        $fail('Tanggal selesai tidak boleh sebelum tanggal mulai.');
                    }
                },
            ],
            'kategori_id' => 'required|exists:pelatihan_kategoris,id',
            'jam' => 'required',
            'lokasi' => $request->tipe == 'offline' ? 'required|string' : 'nullable|string', // Tambahkan validasi kondisional
            'tipe' => 'required|string',
            'penyelenggara' => 'required|string',
            'khusus_umkm_patikraja' => 'boolean',
        ]);

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pelatihan_foto', 'public');
        } else {
            $fotoPath = null;
        }

        // Simpan data pelatihan
        Pelatihan::create([
            'judul' => $request->judul,
            'foto' => $fotoPath,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kategori_id' => $request->kategori_id,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi ?? 'N/A', // Set default jika lokasi kosong
            'tipe' => $request->tipe,
            'penyelenggara' => $request->penyelenggara,
            'khusus_umkm_patikraja' => $request->khusus_umkm_patikraja ?? 0,
        ]);

        return redirect()->route('admin.pelatihans.index')->with('success', 'Pelatihan berhasil ditambahkan.');
    }


    // Tampilkan detail pelatihan
    public function show($id)
    {
        $pelatihan = Pelatihan::with('kategori')->findOrFail($id);
        return view('admin.pages.pelatihan.show', compact('pelatihan'));
    }

    // Form edit pelatihan
    public function edit($id)
{
    $pelatihan = Pelatihan::findOrFail($id);
    $kategoriPelatihan = PelatihanKategori::all(); // Ambil semua kategori

    return view('admin.pages.pelatihan.edit', compact('pelatihan', 'kategoriPelatihan'));
}

    // Simpan perubahan pelatihan
    public function update(Request $request, Pelatihan $pelatihan)
{
    // Validate the incoming request
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date',
        'kategori_id' => 'required|exists:pelatihan_kategoris,id',
        'jam' => 'required|date_format:H:i:s',
        'tipe' => 'required|in:offline,hybrid',
        'lokasi' => 'nullable|string|max:255',
        'penyelenggara' => 'required|string|max:255',
        'khusus_umkm_patikraja' => 'required|boolean',
    ]);

    // Cek jika pengguna ingin menghapus foto
    if ($request->has('hapus_foto') && $request->hapus_foto == 'on') {
        // Hapus foto yang lama jika ada
        if ($pelatihan->foto) {
            Storage::disk('public')->delete($pelatihan->foto);
            $pelatihan->foto = null; // Set foto menjadi null setelah dihapus
        }
        $message = 'Foto berhasil dihapus.';
    } else {
        // Jika ada foto baru, simpan foto tersebut
        if ($request->hasFile('foto')) {
            // Hapus foto lama sebelum menyimpan foto baru
            if ($pelatihan->foto) {
                Storage::disk('public')->delete($pelatihan->foto);
            }
            $fotoPath = $request->file('foto')->store('pelatihan_foto', 'public');
            $pelatihan->foto = $fotoPath;
        }
        $message = 'Foto berhasil diperbarui.';
    }

    // Update pelatihan details
    $pelatihan->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'kategori_id' => $request->kategori_id,
        'jam' => $request->jam,
        'tipe' => $request->tipe,
        'lokasi' => $request->lokasi,
        'penyelenggara' => $request->penyelenggara,
        'khusus_umkm_patikraja' => $request->khusus_umkm_patikraja,
    ]);

    // Set the success message
    return redirect()->route('admin.pelatihans.index')->with('success', $message);
}
    // Hapus pelatihan
    public function destroy($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->delete();

        return redirect()->route('admin.pelatihans.index')->with('success', 'Pelatihan berhasil dihapus.');
    }

}
