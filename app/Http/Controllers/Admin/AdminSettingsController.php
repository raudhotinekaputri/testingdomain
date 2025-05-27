<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return view('admin.pages.settings.index', ['user' => Auth::guard('admin')->user()]);
    }

    public function edit()
    {
        return view('admin.pages.settings.edit', ['user' => Auth::guard('admin')->user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $user->id, // Ganti dari users ke admins
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.settings')->with('success', 'Pengaturan akun berhasil diperbarui!');
    }
}
