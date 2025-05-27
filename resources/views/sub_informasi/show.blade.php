{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold">{{ $subInformasi->judul }}</h1>
    <style>
        .deskripsi-content {
            white-space: pre-line;
        }
    </style>
   <div class="deskripsi-content">
    {!! $subInformasi->deskripsi !!}
</div>

    @if($subInformasi->gambar)
        <div class="text-center">
            <img src="{{ asset('storage/' . $subInformasi->gambar) }}" class="img-fluid rounded" alt="{{ $subInformasi->judul }}" style="max-width: 100%; height: auto;">
        </div>
    @endif

    @if($subInformasi->video)
        <div class="mt-3 text-center">
            <video controls class="w-100 rounded" style="max-height: 300px;">
                <source src="{{ asset('storage/' . $subInformasi->video) }}" type="video/mp4">
                Browser Anda tidak mendukung video ini.
            </video>
        </div>
    @endif

    @if($subInformasi->dokumen)
        <div class="mt-3">
            <a href="{{ asset('storage/' . $subInformasi->dokumen) }}" class="btn btn-primary" target="_blank">Lihat Dokumen</a>
        </div>
    @endif
</div>
@endsection --}}
