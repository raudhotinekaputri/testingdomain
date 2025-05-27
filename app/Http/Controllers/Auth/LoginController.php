<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Menampilkan form login untuk pengguna biasa
    public function showUserLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan form login untuk admin
    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    // Proses login untuk pengguna biasa
    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari user berdasarkan email yang diberikan
        $user = User::where('email', $credentials['email'])->first();

        // Jika user tidak ditemukan, tampilkan pesan error
        if (!$user) {
            Log::error('Login gagal: user tidak ditemukan', ['email' => $credentials['email']]);
            return redirect()->route('login')->withErrors(['error' => 'Email tidak ditemukan.']);
        }

          // Cek email sudah verifikasi atau belum
    if (!$user->hasVerifiedEmail()) {
        return back()->withErrors(['email' => 'Email belum diverifikasi.']);
    }

        // Menyimpan log percobaan login
        Log::info('Login Attempt:', [
            'email' => $credentials['email'],
            'input_password' => $credentials['password'],
            'stored_hashed_password' => $user->password,
            'hash_check' => password_verify($credentials['password'], $user->password), // Memverifikasi password dengan password_verify
        ]);

        // Memeriksa apakah password yang dimasukkan sesuai
        if (!password_verify($credentials['password'], $user->password)) {
            Log::error('Login gagal: password salah', [
                'email' => $credentials['email'],
                'input_password' => $credentials['password'],
                'stored_password' => $user->password,
            ]);
            return redirect()->route('login')->withErrors(['error' => 'Password salah.']);
        }

        // Jika role user adalah admin, login sebagai admin
        if ($user->role == 'admin') {
            Auth::guard('web')->login($user);
            return redirect()->route('admin.dashboard');
        }

        // Di sini, pemeriksaan status persetujuan (approved) sudah dikomentari untuk login pengguna biasa
        /*
        if ($user->approved !== 'approved') {
            return redirect()->route('login')->withErrors(['error' => 'Akun Anda belum disetujui oleh admin.']);
        }
        */

        // Login pengguna biasa
        Auth::guard('web')->login($user);
        return redirect()->route('user.dashboard');
    }

    // Proses login untuk admin
    public function loginAdmin(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari user berdasarkan email yang diberikan
        $user = User::where('email', $credentials['email'])->first();

        // Jika user tidak ditemukan, tampilkan pesan error
        if (!$user) {
            return back()->withErrors(['error' => 'Email tidak ditemukan.']);
        }

        // Memeriksa apakah password yang dimasukkan sesuai
        if (!password_verify($credentials['password'], $user->password)) {
            return back()->withErrors(['error' => 'Password salah.']);
        }

        // Memastikan hanya admin yang dapat login ke panel admin
        if ($user->role !== 'admin') {
            return back()->withErrors(['error' => 'Bukan akun admin.']);
        }

        // Login sebagai admin
        Auth::guard('admin')->login($user);
        return redirect()->route('admin.dashboard');
    }

    // Logout untuk pengguna biasa
    public function logoutUser()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login.user');
    }

    // Logout untuk admin
    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.admin');
    }

    // Setelah login berhasil
    protected function authenticated(Request $request, $user)
    {
        // Memeriksa apakah profil pengguna sudah lengkap
        if (!$user->profile || !$user->profile->nama || !$user->profile->no_whatsapp || !$user->profile->alamat) {
            return redirect()->route('user.profile.edit')->with('warning', 'Silakan lengkapi profil Anda sebelum melanjutkan.');
        }

        // Jika role adalah admin, redirect ke dashboard admin
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Redirect ke dashboard pengguna biasa
        return redirect()->route('user.dashboard');
    }
}
