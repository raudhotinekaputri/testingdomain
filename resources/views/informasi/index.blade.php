@extends('layouts.app')

@section('content')
<div class="container px-3 px-md-5">
    <h1 class="mb-4 text-success">Informasi</h1>

    {{-- Informasi Utama --}}
    @foreach ($informasi as $info)
        <div class="card mb-4 p-3 shadow-sm">
            <h2 class="text-success">{{ $info->judul }}</h2>
            <p>{!! nl2br(e($info->deskripsi)) !!}</p>

            @if($info->gambar)
                <img src="{{ asset('storage/' . $info->gambar) }}" class="img-fluid rounded" width="300">
            @endif

            @if($info->dokumen)
                <p>📄 <strong>Dokumen:</strong>  
                    <a href="{{ asset('storage/' . $info->dokumen) }}" target="_blank">
                        {{ basename($info->dokumen) }}
                    </a>
                </p>
            @endif

            @if($info->video)
                <div class="video-container mt-3">
                    <video controls class="rounded" width="100%">
                        <source src="{{ asset('storage/' . $info->video) }}" type="video/mp4">
                        Browser tidak mendukung pemutaran video.
                    </video>
                </div>
            @endif
        </div>
    @endforeach

    {{-- Dashboard UMKM --}}
    <h2 class="text-success mb-4">Dashboard Data UMKM</h2>

    {{-- Tombol Export PDF --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('export.umkm.pdf') }}" class="btn btn-outline-success btn-sm">📄 Export Data UMKM PDF</a>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-success text-white">
            Data UMKM
        </div>
        <div class="card-body p-3">
            {{-- TABEL RESPONSIF SEMUA DEVICE --}}
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto; overflow-x: auto;">
                <table class="table table-bordered table-sm" style="min-width: 600px;">
                    <thead class="table-success sticky-top">
                        <tr>
                            <th>No</th>
                            <th>Nama Pemilik</th>
                            <th>Alamat</th>
                            <th>Nama Usaha</th>
                            <th>Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($umkmList as $i => $umkm)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $umkm->nama_pemilik }}</td>
                                <td>{{ $umkm->alamat }}</td>
                                <td>{{ $umkm->judul }}</td>
                                <td>{{ $umkm->whatsapp }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Search Sub Informasi --}}
    <h2 class="text-success">Sub Informasi</h2>
    <form action="{{ route('informasi.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari sub informasi..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    {{-- Hasil Sub Informasi --}}
    <div class="row">
        @forelse ($subInformasiList as $sub)
            <div class="col-md-4">
                <div class="card mb-3 p-3 shadow-sm">
                    <h5 class="card-title text-success">{{ $sub->judul }}</h5>
                    <p class="card-text">{{ Str::limit($sub->deskripsi, 100) }}</p>
                    <a href="{{ route('subinformasi.show', $sub->id) }}" class="stretched-link"></a>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada sub informasi yang ditemukan.</p>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
