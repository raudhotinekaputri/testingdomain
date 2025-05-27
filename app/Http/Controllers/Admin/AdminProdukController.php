<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\FotoProduk;
use Illuminate\Support\Facades\Storage;
use App\Models\User; 
use Barryvdh\DomPDF\Facade\Pdf;

class AdminProdukController extends Controller
{
    /**
     * Tampilkan daftar produk.
     */
    public function index(Request $request)
{
    $query = Produk::with('user'); // Tambahkan relasi ke user

    if ($request->has('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
              ->orWhere('nama_pemilik', 'like', '%' . $request->search . '%');
    }

    $produks = $query->paginate(10); // Sesuaikan jumlah per halaman

    return view('admin.pages.produk.index', compact('produks'));
}


    /**
     * Form tambah produk baru.
     */
    public function show($id)
{
    $produk = Produk::with('fotos')->findOrFail($id);
    return view('admin.pages.produk.show', compact('produk'));
}



public function create()
{
    $users = User::all(); 
    $kategoris = Kategori::all(); 

    return view('admin.pages.produk.create', compact('users', 'kategoris'));
}


    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'nama_pemilik' => 'required',
        'alamat' => 'required',
        'whatsapp' => 'required',
        'kategori' => 'required',
        'foto.*' => 'image|mimes:jpeg,png,jpg,gif',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Cek apakah produk diunggah oleh user atau admin
    $userId = auth()->check() ? auth()->id() : null; // Jika user login, set user_id, jika tidak maka null (admin)

    // Simpan data produk
    $produk = Produk::create([
        'judul'        => $request->judul,
        'deskripsi'    => $request->deskripsi,
        'nama_pemilik' => $request->nama_pemilik,
        'alamat'       => $request->alamat,
        'whatsapp'     => $request->whatsapp,
        'kategori'     => $request->kategori,
        'link_olshop'  => $request->link_olshop,
        'link_sosmed'  => $request->link_sosmed,
        'user_id'      => $userId, 
    ]);

    // Simpan thumbnail
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('produk_thumbnails', 'public');
        $produk->thumbnail = $thumbnailPath;
        $produk->save();
    }

    // Simpan foto (maksimal 5)
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $key => $foto) {
            if ($key < 5) { // Maksimal 5 foto
                $path = $foto->store('produk', 'public');
                FotoProduk::create([
                    'produk_id' => $produk->id,
                    'foto'      => $path,
                ]);
            }
        }
    }

    return redirect()->route('admin.produks.index')->with('success', 'Produk berhasil ditambahkan!');
}


    /**
     * Edit produk.
     */
    public function edit($id)
{
    $produk = Produk::with('fotos')->findOrFail($id);
    $users = User::all(); // Jika ingin menampilkan daftar user juga
    $kategoris = Kategori::all(); // Ambil kategori dari database

    return view('admin.pages.produk.edit', compact('produk', 'users', 'kategoris'));
}


    /**
     * Update produk.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'nama_pemilik' => 'required',
        'alamat' => 'required',
        'whatsapp' => 'required',
        'kategori_id' => 'required|exists:kategoris,id',
        'foto.*' => 'image|mimes:jpeg,png,jpg,gif',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    $produk = Produk::findOrFail($id);

    // Update informasi produk
    $produk->update([
        'judul'        => $request->judul,
        'deskripsi'    => $request->deskripsi,
        'nama_pemilik' => $request->nama_pemilik,
        'alamat'       => $request->alamat,
        'whatsapp'     => $request->whatsapp,
        'kategori_id'  => $request->kategori_id,
        'link_olshop'  => $request->link_olshop,
        'link_sosmed'  => $request->link_sosmed,
        'user_id'      => $request->user_id,
    ]);

    // Hapus thumbnail lama jika ada dan simpan thumbnail baru
    if ($request->has('remove_thumbnail') && $produk->thumbnail) {
        Storage::delete('public/' . $produk->thumbnail);
        $produk->thumbnail = null;
        $produk->save();
    }

    // Update thumbnail jika ada yang baru
    if ($request->hasFile('thumbnail')) {
        if ($produk->thumbnail) {
            Storage::delete('public/' . $produk->thumbnail);
        }
        $thumbnailPath = $request->file('thumbnail')->store('produk_thumbnails', 'public');
        $produk->thumbnail = $thumbnailPath;
        $produk->save();
    }

     // Hapus foto yang dipilih
     if ($request->has('delete_photos')) {
        FotoProduk::whereIn('id', $request->delete_photos)->delete();
    }

    // Menangani upload foto baru jika ada
    if ($request->hasFile('new_photos')) {
        foreach ($request->file('new_photos') as $file) {
            $path = $file->store('produk');
            FotoProduk::create([
                'produk_id' => $produk->id,
                'foto' => $path
            ]);
        }
    }

    return redirect()->route('admin.produks.index')->with('success', 'Produk berhasil diperbarui!');
}

    /**
     * Hapus produk.
     */
    public function destroy(Produk $produk)
{
    // Hapus thumbnail jika ada
    if ($produk->thumbnail) {
        Storage::delete('public/' . $produk->thumbnail);
    }

    // Hapus semua foto terkait
    $fotos = FotoProduk::where('produk_id', $produk->id)->get();
    foreach ($fotos as $foto) {
        Storage::delete('public/' . $foto->foto);
        $foto->delete();
    }

    // Hapus produk
    $produk->delete();

    return redirect()->route('admin.produks.index')->with('success', 'Produk berhasil dihapus!');
}

    /**
     * Hapus foto produk secara individual.
     */
    public function deleteFoto(Request $request, $id)
    {
        $foto = FotoProduk::findOrFail($id);
        Storage::delete('public/' . $foto->foto);
        $foto->delete();

        return response()->json(['success' => 'Foto berhasil dihapus']);
    }

    public function export()
{
    $produks = Produk::all();

    $pdf = Pdf::loadView('admin.pages.produk.export', compact('produks'));

    return $pdf->download('daftar-produk.pdf');
}



}
