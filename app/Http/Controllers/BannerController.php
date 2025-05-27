<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('home', compact('banners')); // Menggunakan home.blade.php
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('gambar')->store('banners', 'public');

        Banner::create([
            'gambar' => $path
        ]);

        return redirect()->back()->with('success', 'Banner berhasil ditambahkan!');
    }
}
