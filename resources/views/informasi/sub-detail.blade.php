@extends('layouts.app')

@section('content')
<div class="container px-lg-5 px-md-4 px-3 py-4"> 
    <h1 class="fw-bold mb-4">{{ $subInformasi->judul }}</h1>
  <p class="mb-4" style="white-space: pre-line;">{{ $subInformasi->deskripsi }}</p>

    @if($subInformasi->gambar)
        <div class="mb-4 text-center">
            <img src="{{ asset('storage/' . $subInformasi->gambar) }}" 
                 class="rounded shadow-sm" 
                 style="max-width: 100%; width: 400px; height: auto;" 
                 alt="Gambar">
        </div>
    @endif

    @if($subInformasi->dokumen)
        <div class="mb-4">
            <p>📄 <strong>Dokumen:</strong>  
                <a href="{{ asset('storage/' . $subInformasi->dokumen) }}" target="_blank">
                    {{ basename($subInformasi->dokumen) }}
                </a>
            </p>
        </div>
    @endif

    @if($subInformasi->video)
        <div class="mb-4 text-center">
            <video controls 
                   class="rounded shadow-sm" 
                   style="max-width: 100%; width: 400px; height: auto;">
                <source src="{{ asset('storage/' . $subInformasi->video) }}" type="video/mp4">
                Browser tidak mendukung pemutaran video.
            </video>
        </div>
    @endif

    <a href="{{ route('informasi.index') }}" class="btn btn-secondary mt-3">← Kembali ke Informasi</a>
</div>
@endsection
