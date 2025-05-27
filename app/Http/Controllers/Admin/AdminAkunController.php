<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAkunController extends Controller
{
    public function index()
{
    $admins = Admin::where('id', '!=', Auth::guard('admin')->id())->get();

    return view('admin.pages.admin-akun.index', compact('admins'));
}

    public function create()
    {
        return view('admin.pages.admin-akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admin-akun.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(Admin $admin_akun)
    {
        return view('admin.pages.admin-akun.edit', ['admin' => $admin_akun]);
    }

    public function update(Request $request, Admin $admin_akun)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin_akun->id,
        ]);

        $admin_akun->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.admin-akun.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin_akun)
    {
        $admin_akun->delete();
        return back()->with('success', 'Admin berhasil dihapus.');
    }
}
