@extends('layouts.app')

@section('title', 'Detail Acara')

@section('content')
<div class="container px-4 px-md-5 py-4">
    <h1 class="mb-4">{{ $acara->judul }}</h1>

    <div class="row">
        <div class="col-md-6">
            <!-- Gambar Acara -->
            <img src="{{ asset('storage/' . $acara->foto) }}" class="img-fluid" alt="{{ $acara->judul }}">
        </div>
        <div class="col-md-6">
            <!-- Deskripsi Acara -->
            <p>{{ $acara->deskripsi }}</p>
            <div class="mb-3">
                <strong>Tanggal:</strong> 
                {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->translatedFormat('d F Y') }}
            </div>
            <div class="mb-3">
                <strong>Lokasi:</strong> {{ $acara->lokasi ?? 'Tidak ada lokasi' }}
            </div>

          
            <a href="{{ route('user.acara.index') }}" class="btn btn-primary">Kembali ke Daftar Acara</a>
        </div>
    </div>
</div>
@endsection
