@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Sub Informasi</h1>
    </div>

    @if($subInformasiList->isEmpty())
        <div class="alert alert-warning text-center">
            Belum ada sub informasi yang tersedia.
        </div>
    @else
        <div class="row gx-3 gy-3">
            @foreach($subInformasiList as $subInformasi)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card mb-4 shadow-sm h-100">
                        {{-- Menampilkan gambar jika ada --}}
                        @if($subInformasi->gambar)
                            <div class="p-3">
                                <img src="{{ asset('storage/' . $subInformasi->gambar) }}" class="img-fluid rounded w-100" alt="{{ $subInformasi->judul }}" style="max-height: 200px; object-fit: cover;">
                            </div>
                        @else
                            <div class="p-3">
                                <img src="https://via.placeholder.com/400x250?text=No+Image" class="img-fluid rounded w-100" alt="No Image" style="max-height: 200px; object-fit: cover;">
                            </div>
                        @endif

                        {{-- Menampilkan video jika ada --}}
                        @if($subInformasi->video)
                            <div class="p-3">
                                <video controls class="w-100 rounded" style="max-height: 200px; object-fit: cover;">
                                    <source src="{{ asset('storage/' . $subInformasi->video) }}" type="video/mp4">
                                    Browser tidak mendukung video.
                                </video>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $subInformasi->judul }}</h5>
                            <div class="card-text text-muted flex-grow-1">{!! Str::limit($subInformasi->deskripsi, 100, '...') !!}</div>

                            {{-- Menampilkan dokumen jika ada --}}
                            @if($subInformasi->dokumen)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $subInformasi->dokumen) }}" class="btn btn-outline-secondary btn-sm w-100" target="_blank">
                                        <i class="fas fa-file-alt"></i> Lihat Dokumen
                                    </a>
                                </div>
                            @endif

                            <a href="{{ route('subinformasi.show', $subInformasi->id) }}" class="btn btn-primary w-100 mt-auto">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
