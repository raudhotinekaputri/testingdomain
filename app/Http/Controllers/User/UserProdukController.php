<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\FotoProduk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\UserProfile; 

class UserProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan daftar produk milik user yang sedang login.
     */
    public function index()
{
    //dd(auth()->user()); 
    $produks = Produk::where('user_id', auth()->id())->paginate(10);
    return view('user.produks.index', compact('produks'));
}


    /**
     * Form tambah produk.
     */
    public function create()
    {
         // Cek apakah profil user sudah lengkap
    $profile = UserProfile::where('user_id', auth()->id())->first();

    if (!$profile || !$profile->nama || !$profile->nama_usaha) {
        return redirect()->route('user.profile.edit')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu sebelum menambahkan produk.');
    }
        $kategoris = Kategori::all();
        return view('user.produks.create', compact('kategoris'));
    }

    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
    {
        Log::info('Masuk ke store produk', $request->all());

        try {
            $validatedData = $request->validate([
                'judul'       => 'required|string|max:255',
                'deskripsi'   => 'required',
                'nama_pemilik'=> 'required|string|max:255',
                'alamat'      => 'required|string|max:255',
                'whatsapp'    => 'required|string|max:20',
                'link_olshop' => 'nullable|url',
                'link_sosmed' => 'nullable|url',
                'kategori'    => 'required|string',
                'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'foto.*'      => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            Log::info('Validasi sukses', $validatedData);

            DB::beginTransaction();

            // Simpan thumbnail
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('produk', 'public');
                Log::info('Thumbnail berhasil disimpan', ['path' => $thumbnailPath]);
            }

            // Simpan produk ke database
            $validatedData['user_id'] = auth()->id();
            $validatedData['thumbnail'] = $thumbnailPath;

            $produk = Produk::create($validatedData);
            Log::info('Produk berhasil disimpan', ['produk' => $produk]);


            // Simpan banyak foto produk
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    if ($file->isValid()) {
                        $fotoPath = $file->store('produk', 'public');
                        FotoProduk::create([
                            'produk_id' => $produk->id,
                            'foto' => $fotoPath,
                        ]);
                    }
                }
            }
            

            DB::commit();
            return redirect()->route('user.produks.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan produk', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }

    /**
     * Form edit produk.
     */
    public function edit($id)
    {
        $produk = Produk::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $kategoris = Kategori::all();

        return view('user.produks.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update produk.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'whatsapp' => 'required',
            'kategori' => 'required',
            'nama_pemilik' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        DB::beginTransaction();

        try {
            // Update data produk
            $produk->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'alamat' => $request->alamat,
                'whatsapp' => $request->whatsapp,
                'kategori' => $request->kategori,
                'nama_pemilik' => $request->nama_pemilik,
                'link_olshop' => $request->link_olshop,
                'link_sosmed' => $request->link_sosmed,
            ]);

            // Jika ada thumbnail baru, hapus yang lama dan simpan yang baru
            if ($request->hasFile('thumbnail')) {
                Storage::delete($produk->thumbnail);
                $thumbnailPath = $request->file('thumbnail')->store('produk', 'public');
                $produk->update(['thumbnail' => $thumbnailPath]);
            }
            Log::info('Thumbnail:', [$request->file('thumbnail')]);


            // Hapus foto yang dipilih
            if ($request->has('hapus_foto')) {
                foreach (json_decode($request->hapus_foto, true) as $fotoId) {
                    $foto = FotoProduk::find($fotoId);
                    if ($foto) {
                        Storage::delete($foto->foto);
                        $foto->delete();
                    }
                }
            }

            // Tambah foto baru
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $fotoPath = $file->store('produk', 'public');
                    FotoProduk::create([
                        'produk_id' => $produk->id,
                        'foto'      => $fotoPath,
                    ]);
                }
            }
            Log::info('Foto-foto:', [$request->file('foto')]);


            DB::commit();
            return redirect()->route('user.produks.index')->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal memperbarui produk', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }

    /**
     * Hapus produk.
     */
    public function destroy($id)
    {
        $produk = Produk::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        DB::beginTransaction();

        try {
            // Hapus semua foto terkait
            foreach ($produk->fotoProduks as $foto) {
                Storage::delete($foto->foto);
                $foto->delete();
            }

            // Hapus thumbnail
            Storage::delete($produk->thumbnail);

            // Hapus produk
            $produk->delete();

            DB::commit();
            return redirect()->route('user.produks.index')->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus produk', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }

    /**
     * Tampilkan detail produk.
     */
    public function show($id)
    {
        $produk = Produk::with('fotoProduks')->findOrFail($id);
        return view('user.produks.show', compact('produk'));
    }
}
