@extends('adminlte::page')

@section('title', 'Informasi')

@section('content_header')
    <h1>Informasi</h1>
@endsection

@section('content')

{{-- Notifikasi Sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Detail Informasi</h3>
        <a href="{{ route('admin.informasi.edit', $informasi->id) }}" class="btn btn-primary btn-sm ml-auto">
            <i class="fas fa-edit"></i> Edit Informasi
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="200">Judul</th>
                        <td>{{ $informasi->judul }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $informasi->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Gambar</th>
                        <td class="text-center">
                            @if ($informasi->gambar)
                                <img src="{{ asset('storage/' . $informasi->gambar) }}" class="img-thumbnail info-img">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dokumen</th>
                        <td class="text-center">
                            @if ($informasi->dokumen)
                                <a href="{{ asset('storage/' . $informasi->dokumen) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fas fa-file"></i> Lihat Dokumen
                                </a>
                            @else
                                <span class="text-muted">Tidak ada dokumen</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Video</th>
                        <td class="text-center">
                            @if ($informasi->video)
                                <a href="{{ asset('storage/' . $informasi->video) }}" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fas fa-video"></i> Lihat Video
                                </a>
                            @else
                                <span class="text-muted">Tidak ada video</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
    .info-img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        .btn-sm {
            font-size: 12px;
            padding: 4px 8px;
        }
    }
</style>
@endsection
