<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserProfile;


class UserAuthController extends Controller
{
    public function __construct()
{
    // Hapus middleware 'guest' dari login
    $this->middleware('guest')->except('logout');
}


    public function showLoginForm()
    {
        return view('auth.user_login');

    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();
    
        // Cek apakah user ditemukan
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }
    
        // Pastikan user ditemukan dan status akun sudah disetujui
        // if (!$user || !$user->approved) {
        //     return back()->withErrors(['email' => 'Akun belum disetujui oleh admin.']);
        // }
    
        // Pastikan user ditemukan dan profile sudah lengkap
        // if (!$user || !$user->profile || !$user->profile->is_completed) {
        //     return back()->withErrors(['email' => 'Akun belum memiliki profil lengkap.']);
        // }
    
        // Verifikasi password menggunakan password_verify()
        if (password_verify($request->password, $user->password)) {
            Auth::guard('web')->login($user);
            return redirect()->intended(route('home'));
        }
    
        // Jika login gagal
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    
public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }

public function showRegisterForm()
{
    return view('auth.user-register');
}

public function register(Request $request)
{
    // Validasi data input
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'nama' => 'required|string',
        'no_whatsapp' => 'required|string',
        'alamat' => 'required|string',
        'nama_usaha' => 'required|string',
        'alamat_usaha' => 'required|string',
        'kategori_usaha' => 'nullable|string',
        'nomor_izin_usaha' => 'nullable|string',
        'nomor_whatsapp_usaha' => 'required|string',
        'link_olshop_1' => 'nullable|string',
        'link_olshop_2' => 'nullable|string',
    ]);

    // Buat user baru (password tidak di-hash)
    $user = User::create([
        'email' => $validated['email'],
        'password' => $validated['password'], // Langsung disimpan tanpa hashing
        'approved' => false, // User harus di-acc admin dulu
    ]);

    // Buat user profile
    UserProfile::create([
        'user_id' => $user->id,
        'nama' => $validated['nama'],
        'no_whatsapp' => $validated['no_whatsapp'],
        'alamat' => $validated['alamat'],
        'nama_usaha' => $validated['nama_usaha'],
        'alamat_usaha' => $validated['alamat_usaha'],
        'kategori_usaha' => $validated['kategori_usaha'],
        'nomor_izin_usaha' => $validated['nomor_izin_usaha'],
        'nomor_whatsapp_usaha' => $validated['nomor_whatsapp_usaha'],
        'link_olshop_1' => $validated['link_olshop_1'],
        'link_olshop_2' => $validated['link_olshop_2'],
    ]);

    return redirect()->route('user.login')->with('success', 'Registrasi berhasil! Tunggu persetujuan admin.');
}



}

