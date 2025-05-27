@extends('layouts.app') 

@section('title', 'Registrasi Berhasil')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body text-center">
            <h3>Registrasi Berhasil!</h3>
            <p>Akun Anda sedang menunggu persetujuan dari admin.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a> 
    </div>
</div>
@endsection
