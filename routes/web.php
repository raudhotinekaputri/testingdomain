<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\ProfilOrganisasiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\SubInformasiController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\User\UserPelatihanController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\User\UserProdukController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserAcaraController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PesertaPelatihanController;
use App\Http\Controllers\PesertaAcaraController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\PublicExportController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminKategoriUsahaController;

Auth::routes();

// Halaman login user
Route::get('/login', function () {
    return redirect('/login/user');
})->name('login');

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Banner
Route::post('/banner/simpan', [BannerController::class, 'simpan'])->name('banner.simpan');

//Profile UMKM
Route::get('/umkm', [UMKMController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{id}', [UMKMController::class, 'show'])->name('umkm.show');

//Acara
Route::get('/acaras', [AcaraController::class, 'index'])->name('acaras.index');
Route::get('acaras/{id}', [AcaraController::class, 'show'])->name('acaras.show');
Route::resource('acaras', AcaraController::class);
// Route untuk menampilkan form pendaftaran acara
Route::get('/acaras/{id}/daftar', [PesertaAcaraController::class, 'create'])->name('acaras.daftar');
Route::get('/acaras/{id}/bukti', [PesertaAcaraController::class, 'bukti'])->name('acaras.bukti');
Route::post('/acaras/daftar/store', [PesertaAcaraController::class, 'store'])->name('acaras.peserta.store');


// profil organisasi
Route::get('/profil-organisasi', [ProfilOrganisasiController::class, 'index'])->name('profil_organisasi.index');

// Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

//Informasi
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show'); 

//Sub Informasi
Route::get('/sub-informasi', [SubInformasiController::class, 'index'])->name('subinformasi.index');
Route::get('/sub-informasi/{id}', [SubInformasiController::class, 'show'])->name('subinformasi.show');

//Pelatihan
Route::resource('pelatihans', PelatihanController::class)->except(['show']);
Route::get('pelatihans/{pelatihan}', [PelatihanController::class, 'show'])->name('pelatihans.show');

//Regis
Route::get('/register', [RegisterUserController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterUserController::class, 'register'])->name('register');
Route::get('/register/success', [RegisterUserController::class, 'success'])->name('register.success');

//Login user
Route::get('/login/user', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/login/user', [UserAuthController::class, 'login']);
Route::post('/logout/user', [UserAuthController::class, 'logout'])->name('user.logout');

use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::get('email/resend', [VerificationController::class, 'resend'])->middleware(['auth'])->name('verification.resend');

Route::get('/verify-info', function () {
    return view('auth.verify_guest');
})->name('verification.notice.guest');


Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return redirect()->route('home');
    }

    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::post('/verification/resend', [VerificationController::class, 'resendVerificationEmail'])->name('verification.resend');

//export pdf
Route::get('/export/umkm', [PublicExportController::class, 'exportUmkm'])->name('export.umkm.pdf');
Route::get('/export/produk', [PublicExportController::class, 'exportProduk'])->name('export.produk.pdf');

//Approved user
Route::get('/approval-pending', function () {
    return view('auth.approval-pending');
})->name('approval.pending');

//dashboard user
Route::middleware(['auth', 'email.verified'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

//sertif pelatihan
Route::get('/pelatihan/{id}/sertifikat', [PelatihanController::class, 'lihatSertifikat'])
    ->name('pelatihan.cetakSertifikat');

// Reset password 
Route::get('/lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

//saran
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

//pelatihan user
Route::get('/user/pelatihan', [UserPelatihanController::class, 'index'])->name('user.pelatihan.index');

// Rute untuk menampilkan form pendaftaran
Route::get('pelatihan/{pelatihan_id}/daftar', [PesertaPelatihanController::class, 'create'])->name('pelatihan_peserta.create');

// Rute untuk menyimpan pendaftaran
Route::post('pelatihan/daftar', [PesertaPelatihanController::class, 'store'])->name('pelatihan_peserta.store');
Route::get('pelatihan/pendaftaran/sukses', [PesertaPelatihanController::class, 'sukses'])->name('peserta.pendaftaran.sukses');

//profile user
Route::get('/user/profile', function () {
    return view('user.profile'); // Pastikan file view-nya ada
})->name('user.profile.index');

Route::get('/pelatihan/{id}', [UserPelatihanController::class, 'show'])->name('pelatihan.show');

//pelatihan
Route::middleware(['auth:web'])->prefix('user')->name('user.')->group(function () {
    // Profil User
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    // Pelatihan User (sudah ada)
    Route::get('/pelatihan', [UserPelatihanController::class, 'index'])->name('pelatihan.index');
    Route::get('pelatihan/{id}', [PelatihanController::class, 'show'])->name('pelatihan.show');
    Route::get('/pelatihan/daftar/{id}', [UserPelatihanController::class, 'daftar'])->name('pelatihan.daftar');
    Route::get('/profile/show', [UserProfileController::class, 'show'])->name('profile.show');

    Route::get('/acara', [UserAcaraController::class, 'index'])->name('acara.index');
    Route::get('/acara/{id}', [UserAcaraController::class, 'show'])->name('acara.show');
});


//user produk
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('produks', UserProdukController::class);
});


use App\Http\Controllers\AdminController;

// Panel Admin (Hanya Bisa Diakses Jika Login)
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

//Admin 
use App\Http\Controllers\Admin\AdminAcaraController;
use App\Http\Controllers\Admin\AdminUMKMController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminProfilOrganisasiController;
use App\Http\Controllers\Admin\AdminInformasiController;
use App\Http\Controllers\Admin\AdminSubInformasiController;
use App\Http\Controllers\Admin\AdminPelatihanController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminKategoriProdukController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminAkunController;
use App\Http\Controllers\Admin\AdminFooterController;
use App\Http\Controllers\Admin\AdminKategoriAcaraController;
use \App\Http\Controllers\Admin\AdminPesertaPelatihanController;
use App\Http\Controllers\Admin\AdminPesertaAcaraController;
use App\Http\Controllers\Admin\AdminSaranController;
use App\Http\Controllers\Admin\AdminPelatihanKategoriController;

// ADMIN
Route::get('/login/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/admin', [AdminAuthController::class, 'login']);
Route::post('/logout/admin', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->group(function () {
    Route::prefix('produks')->group(function () { 
        Route::delete('/foto/{id}', [AdminProdukController::class, 'deleteFoto'])
            ->name('admin.produks.foto.delete');
    });
});

//upload sertif pelatihan
Route::get('admin/peserta-pelatihan/{id}/sertifikat', [AdminPesertaPelatihanController::class, 'sertifikatForm'])->name('admin.peserta_pelatihan.sertifikat');
Route::post('admin/peserta-pelatihan/{id}/sertifikat', [AdminPesertaPelatihanController::class, 'sertifikatUpload'])->name('admin.peserta_pelatihan.sertifikat.upload');
Route::delete('admin/peserta-pelatihan/{id}/sertifikat', [AdminPesertaPelatihanController::class, 'sertifikatDelete'])->name('admin.peserta_pelatihan.sertifikat.delete');

//peserta acara
Route::get('admin/peserta-acara/download', [AdminPesertaAcaraController::class, 'downloadPdf'])->name('admin.peserta_acara.download');
Route::get('admin/produks/export', [AdminProdukController::class, 'export'])->name('admin.produk.export');
Route::get('admin/peserta-pelatihan/export-pdf/{pelatihan}', [AdminPesertaPelatihanController::class, 'exportPdf'])->name('admin.peserta_pelatihan.exportPdf');
Route::get('/admin/users/export-pdf', [AdminUserController::class, 'exportPDF'])->name('admin.users.export-pdf');

//pelatihan kategoris
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('pelatihan-kategoris', AdminPelatihanKategoriController::class)->names([
        'index'   => 'pelatihan-kategoris.index',
        'create'  => 'pelatihan-kategoris.create',
        'store'   => 'pelatihan-kategoris.store',
        'edit'    => 'pelatihan-kategoris.edit',
        'update'  => 'pelatihan-kategoris.update',
        'destroy' => 'pelatihan-kategoris.destroy',
    ]);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('acaras', AdminAcaraController::class)->names([
        'index'   => 'admin.acaras.index',
        'create'  => 'admin.acaras.create',
        'store'   => 'admin.acaras.store',
        'show'    => 'admin.acaras.show',
        'edit'    => 'admin.acaras.edit',
        'update'  => 'admin.acaras.update',
        'destroy' => 'admin.acaras.destroy',
    ]);

    Route::resource('kategori-usaha', AdminKategoriUsahaController::class)->names([
        'index'   => 'admin.kategori-usaha.index',
        'create'  => 'admin.kategori-usaha.create',
        'store'   => 'admin.kategori-usaha.store',
        'edit'    => 'admin.kategori-usaha.edit',
        'update'  => 'admin.kategori-usaha.update',
        'destroy' => 'admin.kategori-usaha.destroy',
    ]);
    

    Route::resource('peserta_pelatihan', AdminPesertaPelatihanController::class)->names([
        'index'   => 'admin.peserta_pelatihan.index',
        'create'  => 'admin.peserta_pelatihan.create',
        'store'   => 'admin.peserta_pelatihan.store',
        'show'    => 'admin.peserta_pelatihan.show',
        'edit'    => 'admin.peserta_pelatihan.edit',
        'update'  => 'admin.peserta_pelatihan.update',
        'destroy' => 'admin.peserta_pelatihan.destroy',
    ]);

    Route::get('/admin/peserta-pelatihan/{id}/generate-sertifikat', [AdminPesertaPelatihanController::class, 'generateSertifikat'])
    ->name('admin.peserta_pelatihan.generate_sertifikat');
    
    Route::resource('saran', AdminSaranController::class)->only(['index', 'show', 'destroy', 'update'])->names([
        'index'   => 'saran.index',
        'show'    => 'saran.show',
        'destroy' => 'saran.destroy',
        'update'  => 'saran.update',
    ]);
    

    Route::resource('peserta-acara', AdminPesertaAcaraController::class)->names([
        'index'   => 'admin.peserta_acara.index',
        'create'  => 'admin.peserta_acara.create',
        'store'   => 'admin.peserta_acara.store',
        'show'    => 'admin.peserta_acara.show',
        'edit'    => 'admin.peserta_acara.edit',
        'update'  => 'admin.peserta_acara.update',
        'destroy' => 'admin.peserta_acara.destroy',
    ]);

    Route::resource('umkms', AdminUMKMController::class)->names([
        'index'   => 'admin.umkms.index',
        'create'  => 'admin.umkms.create',
        'store'   => 'admin.umkms.store',
        'edit'    => 'admin.umkms.edit',
        'update'  => 'admin.umkms.update',
        'destroy' => 'admin.umkms.destroy',
    ]);

    Route::resource('produks', AdminProdukController::class)->names([
        'index'   => 'admin.produks.index',
        'create'  => 'admin.produks.create',
        'store'   => 'admin.produks.store',
        'edit'    => 'admin.produks.edit',
        'update'  => 'admin.produks.update',
        'destroy' => 'admin.produks.destroy',
    ]);  

    Route::resource('informasi', AdminInformasiController::class)->except(['show'])->names([
        'index' => 'admin.informasi.index',
        'create' => 'admin.informasi.create',
        'store' => 'admin.informasi.store',
        'edit' => 'admin.informasi.edit',
        'update' => 'admin.informasi.update',
        'destroy' => 'admin.informasi.destroy',
        'show' => 'admin.informasi.show',
    ]);

    Route::resource('profil-organisasi', AdminProfilOrganisasiController::class)->names([
        'index'   => 'admin.profil_organisasi.index',
        'create'  => 'admin.profil_organisasi.create',
        'store'   => 'admin.profil_organisasi.store',
        'edit'    => 'admin.profil_organisasi.edit',
        'update'  => 'admin.profil_organisasi.update',
        'destroy' => 'admin.profil_organisasi.destroy',
    ]);
    

    Route::resource('kategori-acara', AdminKategoriAcaraController::class)->names([
        'index' => 'admin.kategori-acara.index',
        'create' => 'admin.kategori-acara.create',
        'store' => 'admin.kategori-acara.store',
        'edit' => 'admin.kategori-acara.edit',
        'update' => 'admin.kategori-acara.update',
        'destroy' => 'admin.kategori-acara.destroy',
    ]);

    Route::resource('sub-informasi', AdminSubInformasiController::class)->names([
        'index'   => 'admin.sub_informasi.index',
        'create'  => 'admin.sub_informasi.create',
        'store'   => 'admin.sub_informasi.store',
        'edit'    => 'admin.sub_informasi.edit',
        'update'  => 'admin.sub_informasi.update',
        'destroy' => 'admin.sub_informasi.destroy',
    ]);

    Route::resource('footer', AdminFooterController::class)->names([
        'index'  => 'admin.footer.index',
        'edit'   => 'admin.footer.edit',
        'update' => 'admin.footer.update',
    ]);

    Route::resource('pelatihans', AdminPelatihanController::class)->names([
        'index'   => 'admin.pelatihans.index',
        'create'  => 'admin.pelatihans.create',
        'store'   => 'admin.pelatihans.store',
        'show'    => 'admin.pelatihans.show',
        'edit'    => 'admin.pelatihans.edit',
        'update'  => 'admin.pelatihans.update',
        'destroy' => 'admin.pelatihans.destroy',
    ]);

    Route::resource('kategori-produks', AdminKategoriProdukController::class)->names([
        'index'   => 'admin.kategori-produks.index',
        'create'  => 'admin.kategori-produks.create',
        'store'   => 'admin.kategori-produks.store',
        'edit'    => 'admin.kategori-produks.edit',
        'update'  => 'admin.kategori-produks.update',
        'destroy' => 'admin.kategori-produks.destroy',
    ]);

    Route::resource('admin-akun', AdminAkunController::class)->names([
        'index'   => 'admin.admin-akun.index',
        'create'  => 'admin.admin-akun.create',
        'store'   => 'admin.admin-akun.store',
        'show'    => 'admin.admin-akun.show',     
        'edit'    => 'admin.admin-akun.edit',
        'update'  => 'admin.admin-akun.update',
        'destroy' => 'admin.admin-akun.destroy',
    ]);

   

    //admin settings
    Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');
    Route::get('/admin/settings/edit', [AdminSettingsController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/admin/settings/update', [AdminSettingsController::class, 'update'])->name('admin.settings.update');

    Route::patch('/admin/users/{user}/verify-email', [AdminUserController::class, 'verifyEmail'])->name('admin.users.verifyEmail');
   // Route::get('/admin/pelatihan-peserta/{pelatihan_id}', [AdminPelatihanPesertaController::class, 'index'])->name('admin.pelatihan_peserta.index');

    Route::resource('users', AdminUserController::class)->names([
        'index'   => 'admin.users.index',
        'create'  => 'admin.users.create',
        'store'   => 'admin.users.store',
        'edit'    => 'admin.users.edit',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
        'show'    => 'admin.users.show',
    ]);  

    Route::get('/approval-pending', function () {
        return view('auth.approval-pending');
    })->name('approval.pending');
    

    Route::get('users/{user}/edit-profile', [AdminUserController::class, 'editProfile'])->name('admin.users.edit-profile');
    Route::delete('users/{user}/delete-profile', [AdminUserController::class, 'deleteProfile'])->name('admin.users.delete-profile');

    Route::get('/registrasi', [AdminUserController::class, 'registrasi'])->name('admin.registrasi.index');
    Route::patch('/registrasi/{user}/approve', [AdminUserController::class, 'approve'])->name('admin.users.approve');
    Route::patch('/registrasi/{user}/reject', [AdminUserController::class, 'reject'])->name('admin.users.reject');

    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings', [AdminSettingsController::class, 'update'])->name('admin.settings.update');
});
