<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Cari admin berdasarkan email menggunakan model Admin
    $admin = Admin::where('email', $credentials['email'])->first();

    // Verifikasi password menggunakan password_verify
    if ($admin && password_verify($credentials['password'], $admin->password)) {
        Auth::guard('admin')->login($admin);
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors(['email' => 'Login admin gagal']);
}

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
