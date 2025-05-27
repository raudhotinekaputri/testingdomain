<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\KategoriUsaha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserProfileController extends Controller
{
    // Tampilan awal profil (Index)
    public function index()
    {
        $profile = UserProfile::where('user_id', auth()->id())->first();

        if (!$profile) {
            return redirect()->route('user.profile.edit')->with('error', 'Silakan lengkapi profil Anda.');
        }

        return view('user.profile.index', compact('profile'));
    }

    // Tampilan detail profil (Show)
    public function show()
    {
        // Ambil profil berdasarkan user yang sedang login
        $profile = UserProfile::where('user_id', auth()->id())->first();

        // Jika profil tidak ditemukan, arahkan ke halaman edit
        if (!$profile) {
            return redirect()->route('user.profile.edit')->with('error', 'Profil Anda belum lengkap.');
        }

        return view('user.profile.index', compact('profile'));
    }
    // Halaman edit profil
    public function edit()
{
    $user = auth()->user();
    $profile = $user->profile ?? new UserProfile; 
    $kategori_usaha_list = KategoriUsaha::all();

    return view('user.profile.edit', compact('profile', 'kategori_usaha_list'));
}

    // Update profil user
    public function update(Request $request)
{
    $userProfile = UserProfile::updateOrCreate(
        ['user_id' => auth()->id()],
        [
            'nama' => $request->nama,
            'no_whatsapp' => $request->no_whatsapp,
            'alamat' => $request->alamat,
            'nama_usaha' => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'kategori_usaha' => $request->kategori_usaha,
            'nomor_izin_usaha' => $request->nomor_izin_usaha,
            'nomor_whatsapp_usaha' => $request->nomor_whatsapp_usaha,
            'link_olshop_1' => $request->link_olshop_1,
            'link_olshop_2' => $request->link_olshop_2,
            'deskripsi_usaha' => $request->deskripsi_usaha,
        ]
    );

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $path = $file->store('profile_pictures', 'public');
        
        // Hapus foto lama jika ada
        if ($userProfile->profile_picture && Storage::disk('public')->exists($userProfile->profile_picture)) {
            Storage::disk('public')->delete($userProfile->profile_picture);
        }
    
        $userProfile->profile_picture = $path;
        $userProfile->save();
    }
    
    

   // if ($request->filled('kategori_usaha')) {
     //   $userProfile->kategoriUsaha()->sync($request->kategori_usaha);
    //}

    $userProfile->updateProfileStatus();

    return redirect()->route('user.profile.index')->with('success', 'Profil berhasil diperbarui.');
}
}
