<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class AdminFooterController extends Controller
{
    // Menampilkan halaman footer
    public function index()
    {
        $footer = Footer::first(); // Ambil data footer pertama
        return view('admin.pages.footer.index', compact('footer'));
    }

    // Form untuk edit footer
    public function edit($id)
    {
        $footer = Footer::findOrFail($id); // Cari footer berdasarkan id
        return view('admin.footer.edit', compact('footer'));
    }

    // Update footer
    public function update(Request $request, $id)
    {
        // Menemukan footer berdasarkan ID
        $footer = Footer::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'tentang_umkm' => 'nullable|string',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string',
            'facebook' => 'nullable|string', 
            'twitter' => 'nullable|string', 
            'instagram' => 'nullable|string', 
            'linkedin' => 'nullable|string', 
        ]);

       
        $socialMediaFields = ['facebook', 'twitter', 'instagram', 'linkedin'];
        foreach ($socialMediaFields as $field) {

            if (empty($request->input($field))) {
                $request->merge([$field => '-']); 
            }
        }

        $footer->update([
            'tentang_umkm' => $request->input('tentang_umkm') ?: '-',
            'alamat' => $request->input('alamat') ?: '-',
            'email' => $request->input('email') ?: '-',
            'telepon' => $request->input('telepon') ?: '-',
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'linkedin' => $request->input('linkedin'),
        ]);

        return redirect()->route('admin.footer.index')->with('success', 'Footer updated successfully!');
    }
}
