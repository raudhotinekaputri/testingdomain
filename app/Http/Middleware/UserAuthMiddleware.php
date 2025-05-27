<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('user.login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();

        // Komentar bagian pengecekan persetujuan akun
        /*
        if ($user->approved !== 'approved') {
            Auth::logout();
            return redirect()->route('user.login')->withErrors(['email' => 'Akun Anda belum disetujui oleh admin.']);
        }
        */

        // Cek apakah email sudah diverifikasi
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        // Jika semua kondisi terpenuhi, lanjutkan request
        return $next($request);
    }
}
