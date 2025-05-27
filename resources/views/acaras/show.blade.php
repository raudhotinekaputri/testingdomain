@extends('layouts.app')

@section('content')
<div class="container py-4 px-3 px-md-5">
    <h1 class="my-4">{{ $acara->judul }}</h1>

    <!-- Gambar Acara dengan ukuran lebih kecil -->
    <div class="text-center mb-4">
        <img src="{{ $acara->foto ? asset('storage/'.$acara->foto) : asset('images/default-image.jpg') }}" 
     class="img-fluid rounded shadow-sm mx-auto d-block" 
     style="max-width: 400px; height: auto;" 
     alt="{{ $acara->judul }}">
    </div>

    <!-- Deskripsi Acara -->
    <p>{{ $acara->deskripsi }}</p>

    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($acara->tanggal)->translatedFormat('d F Y') }}</p>

    <!-- Tombol Daftar hanya muncul kalau acara menyediakan pendaftaran -->
    <div class="mt-4 d-flex flex-column flex-md-row gap-2">
        @if ($acara->bisa_daftar)
            <a href="{{ route('acaras.daftar', $acara->id) }}" class="btn btn-primary">Daftar Acara</a>
        @endif
        <a href="{{ route('acaras.index') }}" class="btn btn-secondary">Kembali ke Daftar Acara</a>
    </div>
</div>
@endsection
