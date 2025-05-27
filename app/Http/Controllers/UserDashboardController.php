<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\Produk;
use App\Models\Acara;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\UserProfile;

class UserDashboardController extends Controller
{
    public function index()
{
    $user = Auth::guard('web')->user();

    $profile = UserProfile::where('user_id', $user->id)->first();

    if (!$user) {
        return redirect()->route('user.login');
    }

    // Ambil produk user
    $produks = Produk::where('user_id', $user->id)->paginate(3);

     // Ambil acara yang didaftarkan oleh user
     $acaras = Acara::whereIn('id', function($query) use ($user) {
        $query->select('acara_id')
              ->from('peserta_acara')
              ->where('user_id', $user->id);
    })
    ->orderBy('tanggal_mulai', 'desc')  // Menggunakan tanggal_mulai untuk pengurutan
    ->take(5)
    ->get();

    // Ambil pelatihan publik
    $pelatihans = Pelatihan::where('khusus_umkm_patikraja', 0)
    ->orderBy('tanggal_mulai', 'desc')
    ->limit(5)
    ->get()
    ->map(function ($pelatihan) {
        $now = Carbon::now();
        $mulai = Carbon::parse($pelatihan->tanggal_mulai)->startOfDay();
        $selesai = Carbon::parse($pelatihan->tanggal_selesai)->endOfDay(); // <--- penting!

        if ($now->lt($mulai)) {
            $pelatihan->status = 'Belum Dimulai';
        } elseif ($now->between($mulai, $selesai)) {
            $pelatihan->status = 'Sedang Berlangsung';
        } else {
            $pelatihan->status = 'Sudah Selesai';
        }

        return $pelatihan;
    });

    $profileIncomplete = !$profile || !$profile->nama_usaha || !$profile->alamat_usaha || !$profile->deskripsi_usaha;

     return view('user.dashboard', compact('produks', 'pelatihans', 'profileIncomplete', 'acaras'));

}

public function dashboard()
{
    return view('user.dashboard');  // Untuk user
}


}
