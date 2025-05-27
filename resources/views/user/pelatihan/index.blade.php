@extends('layouts.app')

@section('title', 'Pelatihan Saya')

@section('content')
<div class="container px-4 px-md-5 py-4">
    <h1 class="mb-4">Pelatihan Saya</h1>

    <div class="row gx-4 gy-4">
        <!-- Pelatihan Sedang Berlangsung -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sedang Berlangsung</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($pelatihan_sedang as $pelatihan)
                            <li class="list-group-item">
                                <h6 class="mb-1">{{ $pelatihan->judul }}</h6>
                                <div class="mb-1">
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }}
                                        - 
                                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}
                                    </small>
                                </div>
                                <div>
                                    <small class="text-muted">{{ ucfirst($pelatihan->tipe) }} @if($pelatihan->lokasi) | {{ $pelatihan->lokasi }} @endif</small>
                                </div>
                                <p class="mb-0">{{ $pelatihan->deskripsi }}</p>
                                <a href="{{ route('pelatihan.show', $pelatihan->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Tidak ada pelatihan yang sedang berlangsung.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Pelatihan yang Pernah Diikuti -->
        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Sudah Selesai</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($pelatihan_selesai as $pelatihan)
                            <li class="list-group-item">
                                <h6 class="mb-1">{{ $pelatihan->judul }}</h6>
                                <div class="mb-1">
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }}
                                        - 
                                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}
                                    </small>
                                </div>
                                <p class="mb-0">{{ $pelatihan->deskripsi }}</p>
                                <a href="{{ route('user.pelatihan.show', $pelatihan->id) }}" class="btn btn-success btn-sm">Lihat Detail</a>

                                @if ($pelatihan->sertifikat)
                                    <a href="{{ asset('storage/' . $pelatihan->sertifikat) }}" target="_blank" class="btn btn-success btn-sm ml-2">Lihat Sertifikat</a>
                                    <a href="{{ asset('storage/' . $pelatihan->sertifikat) }}" download class="btn btn-outline-success btn-sm ml-2">Download Sertifikat</a>
                                @else
                                    <button class="btn btn-secondary btn-sm ml-2" disabled>Sertifikat Tidak Tersedia</button>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada pelatihan yang selesai kamu ikuti.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
