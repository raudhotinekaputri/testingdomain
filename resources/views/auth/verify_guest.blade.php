@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">
                    Verifikasi Email Anda
                </div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p class="mb-2">Terima kasih telah mendaftar! Kami telah mengirimkan email verifikasi ke alamat yang Anda daftarkan.</p>
                    <p class="mb-2">Silakan buka email Anda dan klik tautan verifikasi untuk mengaktifkan akun Anda.</p>
                    <p class="mb-3">Tidak menerima email? Klik tombol di bawah untuk mengirim ulang email verifikasi.</p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Masukkan email Anda" required class="form-control mb-3">
                        <button type="submit" class="btn btn-success">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
