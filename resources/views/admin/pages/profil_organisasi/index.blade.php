@extends('adminlte::page')

@section('title', 'Profil Organisasi')

@section('content_header')
    <h1>Profil Organisasi</h1>
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
        <h3 class="card-title">Detail Profil Organisasi</h3>
        <a href="{{ route('admin.profil_organisasi.edit', $profil->id) }}" class="btn btn-primary btn-sm ml-auto">
            <i class="fas fa-edit"></i> Edit Profil
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="200">Judul</th>
                        <td>{{ $profil->judul }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $profil->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Banner</th>
                        <td class="text-center">
                            @if ($profil->banner)
                                <img src="{{ asset('storage/' . $profil->banner) }}" class="img-thumbnail profil-banner">
                            @else
                                <span class="text-muted">Tidak ada banner</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Judul Bagan</th>
                        <td>{{ $profil->bagan_judul }}</td>
                    </tr>
                    <tr>
                        <th>Bagan Organisasi</th>
                        <td class="text-center">
                            @if ($profil->bagan_gambar)
                                <img src="{{ asset('storage/' . $profil->bagan_gambar) }}" class="img-thumbnail profil-bagan">
                            @else
                                <span class="text-muted">Tidak ada bagan</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Visi</th>
                        <td>{{ $profil->visi }}</td>
                    </tr>
                    <tr>
                        <th>Misi</th>
                        <td>{{ $profil->misi }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
    .profil-banner {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .profil-bagan {
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
