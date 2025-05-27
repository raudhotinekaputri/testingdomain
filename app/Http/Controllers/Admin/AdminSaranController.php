<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saran;
use Illuminate\Http\Request;

class AdminSaranController extends Controller
{
    public function index() {
        $sarans = Saran::paginate(10);
        return view('admin.pages.saran.index', compact('sarans'));
    }

    public function show($id) {
        $saran = Saran::findOrFail($id);
        return view('admin.pages.saran.show', compact('saran'));
    }

    public function destroy($id) {
        $saran = Saran::findOrFail($id);
        $saran->delete();
        return redirect()->route('saran.index')->with('success', 'Saran berhasil dihapus.');
    }

    public function update(Request $request, $id)
{
    $saran = Saran::findOrFail($id);

    // Update status is_read berdasarkan checkbox
    $saran->is_read = $request->has('is_read') ? true : false;
    $saran->save();

    // Tentukan pesan sukses berdasarkan perubahan status
    $statusMessage = $saran->is_read 
        ? 'Saran berhasil ditandai sebagai sudah ditangani' 
        : 'Saran berhasil ditandai sebagai belum ditangani';

    // Redirect ke index dengan flash message
    return redirect()->route('saran.index')->with('status', $statusMessage);
}

}
