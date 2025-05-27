<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesertaPelatihan;
use App\Models\Pelatihan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPesertaPelatihanController extends Controller
{
    public function index(Request $request)
    {
        // Inisialisasi query untuk mengambil peserta pelatihan
        $query = PesertaPelatihan::with('pelatihan');
        
        // Filter berdasarkan pelatihan jika diisi
        if ($request->filled('pelatihan_id')) {
            $query->where('pelatihan_id', $request->pelatihan_id);
        }
    
        // Ambil semua peserta sesuai filter dan paginate
        $pesertas = $query->paginate(15);
    
        // Ambil daftar pelatihan untuk dropdown filter
        $pelatihans = Pelatihan::all();
    
        return view('admin.pages.peserta_pelatihan.index', compact('pesertas', 'pelatihans'));
    }
    
    public function exportPdf($pelatihanId)
{
    if ($pelatihanId) {
        $pesertaPelatihan = PesertaPelatihan::where('pelatihan_id', $pelatihanId)->get();
        $pelatihan = Pelatihan::find($pelatihanId);
    
        if (!$pelatihan) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan!');
        }

        $pdf = PDF::loadView('admin.pages.peserta_pelatihan.export_pdf', compact('pesertaPelatihan', 'pelatihan'));
        return $pdf->download('daftar-peserta-pelatihan-' . $pelatihan->judul . '.pdf');
    }

    return redirect()->back()->with('error', 'ID pelatihan tidak valid.');
}

   
    public function exportPdfAll()
{
    // Ambil semua data peserta beserta relasi pelatihan
    $pesertaPelatihan = PesertaPelatihan::with('pelatihan')->get();

    // Kirim ke view PDF yang dibuat khusus untuk semua data
    $pdf = PDF::loadView('admin.pages.peserta_pelatihan.export_pdf_semua', compact('pesertaPelatihan'));

    // Download file PDF
    return $pdf->download('semua-daftar-peserta-pelatihan.pdf');
}

    public function create()
    {
        $pelatihans = Pelatihan::all(); 
        $users = User::all();

        return view('admin.pages.peserta_pelatihan.create', compact('pelatihans','users'));
    }

    public function store(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'pelatihan_id' => 'required|exists:pelatihans,id',
        'nama' => 'required|string',
        'whatsapp' => 'required|string',
        'email' => 'required|email',
        'alamat' => 'nullable|string', 
        'nama_usaha' => 'nullable|string|max:255',
    ]);

    // Menyimpan data peserta pelatihan
    PesertaPelatihan::create([
        'user_id' => $request->user_id,
        'pelatihan_id' => $request->pelatihan_id,
        'nama' => $request->nama,
        'whatsapp' => $request->whatsapp,
        'email' => $request->email,
        'alamat' => $request->alamat, 
        'nama_usaha' => $request->nama_usaha,
    ]);

    return redirect()->route('admin.peserta_pelatihan.index')->with('success', 'Peserta berhasil ditambahkan!');
}


    public function edit($id)
{
    $peserta = PesertaPelatihan::findOrFail($id);
    
    // Mengecek apakah ada pengguna yang login
    $users = auth()->check() ? User::all() : []; // Jika user tidak login, $users kosong

    $pelatihans = Pelatihan::all();

    return view('admin.pages.peserta_pelatihan.edit', compact('peserta', 'users', 'pelatihans'));
}


public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'user_id' => 'nullable|exists:users,id', // user_id opsional
        'pelatihan_id' => 'required|exists:pelatihans,id', // pelatihan_id wajib ada
        'nama' => 'nullable|string|max:255',
        'whatsapp' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'alamat' => 'nullable|string',
        'nama_usaha' => 'nullable|string|max:255',
    ]);

    // Mengambil data peserta yang akan diupdate
    $peserta = PesertaPelatihan::findOrFail($id);

    // Update data peserta
    $peserta->update([
        'user_id' => $request->user_id,  
        'pelatihan_id' => $request->pelatihan_id,
        'nama' => $request->nama,
        'whatsapp' => $request->whatsapp,
        'email' => $request->email,
        'alamat' => $request->alamat,
        'nama_usaha' => $request->nama_usaha,
    ]);

    return redirect()->route('admin.peserta_pelatihan.index')->with('success', 'Peserta berhasil diperbarui.');
}

    public function destroy($id)
    {
        $peserta = PesertaPelatihan::findOrFail($id);
        $peserta->delete();

        return redirect()->route('admin.peserta_pelatihan.index')->with('success', 'Peserta berhasil dihapus!');
    }

    public function show($id)
{
    $peserta = PesertaPelatihan::with('pelatihan')->findOrFail($id);
    return view('admin.pages.peserta_pelatihan.show', compact('peserta'));
}


public function sertifikatForm($id)
{
    $peserta = PesertaPelatihan::findOrFail($id);
    
    return view('admin.pages.peserta_pelatihan.sertifikat', compact('peserta'));
}
public function sertifikatUpload(Request $request, $id)
{
    // Ambil data peserta pelatihan
    $peserta = PesertaPelatihan::findOrFail($id);
    $pelatihan = $peserta->pelatihan;

    // Validasi jika pelatihan belum selesai
    if ($pelatihan && $pelatihan->tanggal_selesai > now()) {
        return redirect()->back()->with('error', 'Sertifikat hanya bisa diunggah setelah pelatihan selesai.');
    }

    // Validasi file sertifikat
    $request->validate([
        'file_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // Hapus file sertifikat lama jika ada
    if ($peserta->file_sertifikat) {
        Storage::disk('public')->delete($peserta->file_sertifikat);
    }

    // Upload file sertifikat baru
    $file = $request->file('file_sertifikat');
    $filePath = $file->storeAs('sertifikat_peserta', time() . '_' . $file->getClientOriginalName(), 'public');

    // Update data peserta dengan file sertifikat baru
    $peserta->update([
        'file_sertifikat' => $filePath,
    ]);

    return redirect()->back()->with('success', 'Sertifikat berhasil diupload!');
}

public function sertifikatDelete($id)
{
    $peserta = PesertaPelatihan::findOrFail($id);
    if ($peserta->file_sertifikat) {
        Storage::delete('public/storage/' . $peserta->file_sertifikat);
        $peserta->file_sertifikat = null;
        $peserta->save();
    }

    return redirect()->back()->with('success', 'Sertifikat berhasil dihapus!');
}

public function generateSertifikat($id)
{
    $peserta = PesertaPelatihan::with('pelatihan')->findOrFail($id);

    if (!$peserta->nama || !$peserta->pelatihan) {
        return redirect()->back()->with('error', 'Data peserta atau pelatihan tidak lengkap.');
    }

    $pdf = PDF::loadView('admin.pages.peserta_pelatihan.sertifikat_pdf', compact('peserta'))
        ->setPaper('A4', 'potrait');

    // Menampilkan PDF langsung di browser
    return $pdf->stream('sertifikat-' . \Str::slug($peserta->nama) . '.pdf');
}

}
