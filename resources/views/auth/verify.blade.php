@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Email Anda</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <p>Terima kasih telah mendaftar. Sebelum melanjutkan, kami membutuhkan Anda untuk memverifikasi email Anda terlebih dahulu. Cek inbox email Anda dan klik link verifikasi yang kami kirimkan.</p>
                    <p>Jika Anda tidak menerima email, klik tombol di bawah untuk mengirimkan ulang email verifikasi.</p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
