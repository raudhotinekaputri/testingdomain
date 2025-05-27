<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\KategoriAcara;

class AcaraController extends Controller
{
    /**
     * Tampilkan daftar acara
     */
    public function index(Request $request)
    {
        $query = Acara::query();
    
        // Filter kategori berdasarkan ID
    if ($request->filled('kategori')) {
        $query->where('kategori_id', $request->kategori);
    }

    // Filter bulan dari 'tanggal_mulai'
if ($request->filled('bulan')) {
    $query->whereMonth('tanggal_mulai', $request->bulan);
}

// Urutkan acara dari tanggal_mulai terbaru
$query->orderBy('tanggal_mulai', 'desc');

        // Ambil semua hasil
        $acaras = $query->get();
    
        // Ambil acara terbaru sebagai highlight
        $acarasTerbaru = $acaras->first();
        $acarasLainnya = Acara::where('id', '!=', $acarasTerbaru->id)
    ->latest()
    ->paginate(12); // 3 kolom x 4 baris = 12 item per halaman

    
        // Ambil semua kategori dari tabel kategori_acaras
        $kategoriList = KategoriAcara::all();
    
        return view('acaras.index', compact('acarasTerbaru', 'acarasLainnya', 'kategoriList'));
    }
    /**
     * Tampilkan detail acara
     */
    public function show($id)
    {
        $acara = Acara::findOrFail($id);
        return view('acaras.show', compact('acara'));
    }    
    /**find */
    

    /**
     * Form tambah acara (hanya bisa diakses admin)
     */
    public function create()
    {
        $kategoriList = KategoriAcara::all();
    return view('acaras.create', compact('kategoriList'));
    }

    /**
     * Simpan acara baru ke db
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'kategori_id' => 'required|exists:kategori_acaras,id',
        'foto' => 'nullable|image|max:2048',
    ]);

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('acaras', 'public');
    }

    Acara::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'kategori_id' => $request->kategori_id,
        'foto' => $fotoPath,
    ]);

    return redirect()->route('acaras.index')->with('success', 'Acara berhasil ditambahkan!');
}


    /**
     * Form edit acara
     */
    public function edit(Acara $acara)
    {
        $kategoriList = KategoriAcara::all();
    return view('acaras.edit', compact('acara', 'kategoriList'));
    }

    /**
     * Update acara di database
     */
    public function update(Request $request, Acara $acara)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_acaras,id',
            'foto' => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('foto')) {
            if ($acara->foto) {
                Storage::disk('public')->delete($acara->foto);
            }
            $acara->foto = $request->file('foto')->store('acaras', 'public');
        }
    
        $acara->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id, // <-- ini diganti
        ]);
    
        return redirect()->route('acaras.index')->with('success', 'Acara berhasil diperbarui!');
    }
    

    /**
     * Hapus acara
     */
    public function destroy(Acara $acara)
    {
        if ($acara->foto) {
            Storage::disk('public')->delete($acara->foto);
        }

        $acara->delete();

        return redirect()->route('acaras.index')->with('success', 'Acara berhasil dihapus!');
    }

    /**
     * Daftar acara
     */
    public function daftar($id)
{
    $acara = Acara::findOrFail($id);

    if (!$acara->bisa_daftar) {
        abort(403, 'Acara ini tidak menyediakan pendaftaran.');
    }

    return view('acaras.daftar', compact('acara'));
}

}

