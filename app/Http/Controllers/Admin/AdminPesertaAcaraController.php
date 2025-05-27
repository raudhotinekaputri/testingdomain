<?php

namespace App\Http\Controllers\Admin;

use App\Models\PesertaAcara;
use App\Models\Acara;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminPesertaAcaraController extends Controller
{
    // Menampilkan daftar peserta acara
    public function index(Request $request)
{
    $pesertaAcara = PesertaAcara::query();

    $query = Acara::query();

         // Filter berdasarkan judul acara
    if ($request->has('acara_id') && $request->acara_id !== '') {
        $pesertaAcara->where('acara_id', $request->acara_id);
    }


    $pesertaAcara = $pesertaAcara->get();
    $acaras = Acara::all();
    return view('admin.peserta_acara.index', compact('pesertaAcara', 'acaras'));

}

    // Menampilkan form untuk menambahkan peserta acara baru
    public function create()
    {
        // Mengambil semua acara untuk pilihan
        $acaras = Acara::all();
        return view('admin.peserta_acara.create', compact('acaras'));
    }

    // Menyimpan data peserta acara yang baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'acara_id' => 'required|exists:acaras,id',
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
        ]);

        // Menyimpan data peserta acara ke dalam database
        PesertaAcara::create([
            'acara_id' => $request->acara_id,
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.peserta_pelatihan.index')->with('success', 'Peserta acara berhasil ditambahkan!');
    }

    // Menampilkan detail peserta acara
    public function show($id)
    {
        $pesertaAcara = PesertaAcara::findOrFail($id);
        return view('admin.peserta_acara.show', compact('pesertaAcara'));
    }

    // Menampilkan form untuk mengedit peserta acara
    public function edit($id)
    {
        $pesertaAcara = PesertaAcara::findOrFail($id);
        $acaras = Acara::all();
        return view('admin.peserta_acara.edit', compact('pesertaAcara', 'acaras'));
    }

    // Memperbarui data peserta acara
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'acara_id' => 'required|exists:acaras,id',
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
        ]);

        // Update data peserta acara di database
        $pesertaAcara = PesertaAcara::findOrFail($id);
        $pesertaAcara->update([
            'acara_id' => $request->acara_id,
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.peserta_pelatihan.index')->with('success', 'Peserta acara berhasil diperbarui!');
    }

    // Menghapus data peserta acara
    public function destroy($id)
    {
        $pesertaAcara = PesertaAcara::findOrFail($id);
        $pesertaAcara->delete();

        return redirect()->route('admin.peserta_pelatihan.index')->with('success', 'Peserta acara berhasil dihapus!');
    }

    public function downloadPdf(Request $request)
{
    $query = PesertaAcara::query()->with('acara');

    if ($request->has('acara_id') && $request->acara_id !== '') {
        $query->where('acara_id', $request->acara_id);
    }

    $pesertaAcara = $query->get();

    $pdf = PDF::loadView('admin.peserta_acara.pdf', compact('pesertaAcara'));

    return $pdf->download('peserta_acara.pdf');
}


}
