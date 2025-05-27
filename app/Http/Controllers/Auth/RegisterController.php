<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses registrasi user baru
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
    
        try {
            // Membuat akun user baru
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'approved' => 'pending',
            ]);

            // Event untuk email verifikasi (kalau digunakan)
            event(new Registered($user));

            // Kirim email verifikasi manual (kalau diaktifkan)
            // $user->sendEmailVerificationNotification();  
    
            return redirect()->route('verification.notice')
                ->with('message', 'Email verifikasi telah dikirim. Silakan verifikasi email Anda.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
