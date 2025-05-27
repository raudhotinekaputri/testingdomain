<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\KategoriUsaha;
use PDF; 
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Registered;

class AdminUserController extends Controller
{
    public function index(Request $request)
{
   // $query = User::with('profile')->where('approved', 'approved'); // Hanya query untuk user yang approved
   $query = User::with('profile');
   
    if ($request->has('search') && $request->search != '') {
        $query->where('email', 'like', '%' . $request->search . '%');
    }

    $users = $query->paginate(10)->appends($request->only('search'));

    return view('admin.pages.user.index', compact('users'));
}


    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Kirim email verifikasi
    event(new Registered($user));

    return redirect()->route('admin.users.index')
        ->with('success', 'User berhasil dibuat. Silakan minta user untuk verifikasi email.');
}
public function createProfile($id)
{
    $user = User::findOrFail($id);
    return view('admin.pages.user.profile', compact('user'));
}

public function storeProfile(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'no_whatsapp' => 'required',
        'alamat' => 'required',
        'nama_usaha' => 'required',
        'alamat_usaha' => 'required',
        'kategori_usaha' => 'nullable|exists:kategori_usahas,id',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Simpan atau update data profil tanpa foto dulu
    $profile = UserProfile::updateOrCreate(
        ['user_id' => $user->id],
        [
            'nama' => $request->nama,
            'no_whatsapp' => $request->no_whatsapp,
            'alamat' => $request->alamat,
            'nama_usaha' => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
'kategori_usaha' => $request->kategori_usaha ?: null, 
            'nomor_izin_usaha' => $request->nomor_izin_usaha ?: null,
            'nomor_whatsapp_usaha' => $request->nomor_whatsapp_usaha,
            'link_olshop_1' => $request->link_olshop_1,
            'link_olshop_2' => $request->link_olshop_2,
            'deskripsi_usaha' => $request->deskripsi_usaha,
        ]
    );

    // Cek dan simpan foto jika ada
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('profile_pictures', 'public');
       // $profile->foto = $path;
       $profile->profile_picture = $path; 
        $profile->save(); 
    }

    return redirect()->route('admin.users.index')->with('success', 'Profil user berhasil disimpan.');
}


public function edit($id)
{
    $user = User::with('profile')->findOrFail($id);

    if (!$user->profile) {
        $user->profile()->create([
            'nama' => '',
            'no_whatsapp' => '',
            'alamat' => '',
            'nama_usaha' => '',
            'alamat_usaha' => '',
            'kategori_usaha' => null,
            'nomor_izin_usaha' => null,
            'nomor_whatsapp_usaha' => '',
            'link_olshop_1' => '',
            'link_olshop_2' => '',
            'deskripsi_usaha' => '',
        ]);
    }

    $kategori_usaha_list = KategoriUsaha::pluck('nama', 'id');

    return view('admin.pages.user.edit', compact('user', 'kategori_usaha_list'));
}


// Edit profil user
public function editProfile($id)
{
    $user = User::findOrFail($id);
    //return view('admin.users.edit-profile', compact('user'));
    return view('admin.pages.user.edit-profile', compact('user')); // ✅ sesuai struktur folder

}

// Delete profil user
public function deleteProfile($id)
{
    $user = User::findOrFail($id);

    if ($user->profile) {
        $user->profile->delete();
        return redirect()->route('admin.users.index')->with('success', 'Profil user berhasil dihapus.');
    }

    return redirect()->route('admin.users.index')->with('error', 'Profil user tidak ditemukan.');
}

// Update data user
public function update(Request $request, $id)
{
    $user = User::with('profile')->findOrFail($id);

    // Cek apakah user punya profile
    if (!$user->profile || !$user->profile->nama) {
        return redirect()->back()->with('error', 'Isi profil terlebih dahulu sebelum mengubah password.');
    }

    // Validasi email dan password (jika ada)
    $request->validate([
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
    ]);

    $user->email = $request->email;

    // Update password jika diisi
    if ($request->filled('password')) {
        $user->password = \Hash::make($request->password);
    }

    $user->save();

    // Update data profile
    $profile = $user->profile;

    $profile->nama = $request->nama;
    $profile->no_whatsapp = $request->no_whatsapp;
    $profile->alamat = $request->alamat;
    $profile->nama_usaha = $request->nama_usaha;
    $profile->alamat_usaha = $request->alamat_usaha;
    $profile->kategori_usaha = $request->kategori_usaha;
    $profile->nomor_izin_usaha = $request->nomor_izin_usaha;
    $profile->nomor_whatsapp_usaha = $request->nomor_whatsapp_usaha;
    $profile->deskripsi_usaha = $request->deskripsi_usaha;

    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('profile_pictures', 'public');
        $profile->foto = $path;
    }

    $profile->save();

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->profile()->delete();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }

    //public function profile()
    //{
   //     return $this->hasOne(UserProfile::class);
  //  }

    public function approve(User $user)
{
    // Cek apakah user belum disetujui
    if ($user->approved === 'pending') {
        // Menandakan bahwa user telah disetujui
        $user->approved = 'approved';
        
        // Verifikasi email user langsung
        $user->markEmailAsVerified();  // Menandai email sebagai terverifikasi

        // Simpan perubahan status user
        $user->save();

        return redirect()->route('admin.registrasi.index')->with('success', 'User berhasil disetujui dan email telah diverifikasi.');
    }

    return redirect()->route('admin.registrasi.index')->with('error', 'User sudah disetujui atau tidak perlu disetujui.');
}

public function reject(User $user)
{
    // Set status user menjadi 'rejected'
    $user->approved = 'rejected';
    $user->save();

    return redirect()->route('admin.registrasi.index')->with('success', 'User berhasil ditolak.');
}

    public function registrasi()
{
    $users = User::where('approved', '!=', 'approved')->paginate(10);
    return view('admin.pages.user.registrasi', compact('users'));
}

    public function registrasiIndex()
{
    // Ambil user yang belum diapprove
    $users = User::where('approved', 'pending')->paginate(10);
    return view('admin.pages.registrasi.index', compact('users'));
}

public function verifyEmail(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->email_verified_at = now();
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Email berhasil diverifikasi');
}

public function show($id)
{
    $user = User::findOrFail($id);

    return view('admin.pages.user.show', compact('user'));
}

public function exportPDF(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $users = User::with('profile')
        ->whereBetween('created_at', [
            $startDate . ' 00:00:00',
            $endDate . ' 23:59:59',
        ])
        ->get();

    $pdf = Pdf::loadView('admin.pages.user.export-pdf', [
        'users' => $users,
        'startDate' => $startDate,
        'endDate' => $endDate,
    ]);

    return $pdf->download('data_user_umkm.pdf');
}
}
