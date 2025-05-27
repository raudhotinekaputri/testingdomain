<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterUserController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat user baru tanpa approved, tapi siapkan flag profile_completed = false
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_completed' => false, 
        ]);

        $user->sendEmailVerificationNotification();  // Pastikan verifikasi dijalankan

event(new Registered($user));

return redirect()->route('verification.notice.guest')
    ->with('message', 'Email verifikasi telah dikirim. Silakan cek email Anda.');
    }

}
