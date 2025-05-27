<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Events\Verified as EmailVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Validasi hash dari email
        if (! hash_equals((string) $hash, sha1($user->email))) {
            abort(403, 'Link verifikasi tidak valid.');
        }

        // Jika sudah diverifikasi
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('status', 'Email sudah diverifikasi.');
        }

        // Tandai sebagai diverifikasi
        if ($user instanceof MustVerifyEmail && $user->markEmailAsVerified()) {
            event(new EmailVerified($user));
        }
        

        return redirect()->route('home')->with('status', 'Email berhasil diverifikasi!');
    }

    public function show(Request $request)
    {
        // Misalnya arahkan ke tampilan kustom
        return view('auth.verify_guest'); 
    }
    
    public function resendVerificationEmail(Request $request)
    {
        // Cek apakah pengguna dengan email yang diberikan sudah terdaftar
        $user = User::where('email', $request->email)->first();

        // Pastikan pengguna terdaftar dan belum terverifikasi
        if ($user && !$user->hasVerifiedEmail()) {
            // Kirim ulang email verifikasi
            $user->sendEmailVerificationNotification();

            // Kirim pesan sukses ke session
            Session::flash('message', 'Email verifikasi telah berhasil dikirim ulang. Silakan cek email Anda!');
        } else {
            // Jika pengguna tidak ditemukan atau sudah terverifikasi
            Session::flash('error', 'Akun tidak ditemukan atau sudah terverifikasi!');
        }

        // Kembali ke halaman yang sama
        return back();
    }
}
