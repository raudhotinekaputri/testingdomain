@extends('layouts.app')

@section('title', 'Detail Pelatihan')

@section('content')
<div class="container px-4 px-md-5 py-4">
    <h1 class="mb-4">{{ $pelatihan->judul }}</h1>
    @if ($pelatihan->foto)
    <div class="mb-4 flex justify-center">
        <img src="{{ asset('storage/' . $pelatihan->foto) }}"
             alt="Foto Pelatihan"
             class="rounded shadow w-full max-w-[250px] h-auto">
    </div>
@endif


    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">
                {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }}
                - 
                {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}
            </h5>
            <p class="card-text">{{ $pelatihan->deskripsi }}</p>
            <p class="text-muted">
                Tipe: {{ ucfirst($pelatihan->tipe) }}
                @if($pelatihan->lokasi)
                    | Lokasi: {{ $pelatihan->lokasi }}
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
