@extends('layouts.app')

@section('title', 'Acara Saya')

@section('content')
<div class="container px-4 px-md-5 py-4">
    <h1 class="mb-4">Acara yang Terdaftar</h1>

    <div class="row gx-4 gy-4">
        <!-- Acara Sedang Berlangsung -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sedang Berlangsung</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($acaras_sedang as $acara)
                            <li class="list-group-item">
                                <h6 class="mb-1">{{ $acara->judul }}</h6>
                                <div class="mb-1">
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->translatedFormat('d F Y') }}
                                        - 
                                        {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->translatedFormat('d F Y') }}
                                    </small>
                                </div>
                                <p class="mb-0">{{ $acara->deskripsi }}</p>
                                <a href="{{ route('user.acara.show', $acara->id) }}" class="btn btn-primary btn-sm mt-2">Lihat Detail</a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Tidak ada acara yang sedang berlangsung.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Acara yang Sudah Selesai -->
        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Sudah Selesai</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($acaras_selesai as $acara)
                            <li class="list-group-item">
                                <h6 class="mb-1">{{ $acara->judul }}</h6>
                                <div class="mb-1">
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->translatedFormat('d F Y') }}
                                        - 
                                        {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->translatedFormat('d F Y') }}
                                    </small>
                                </div>
                                <p class="mb-0">{{ $acara->deskripsi }}</p>
                                <a href="{{ route('user.acara.show', $acara->id) }}" class="btn btn-primary btn-sm mt-2">Lihat Detail</a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada acara yang selesai kamu ikuti.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
