@extends('adminlte::page')

@section('title', 'Deskripsi UMKM')

@section('content_header')
    <h1>Deskripsi UMKM</h1>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@foreach ($umkms as $umkm)
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Detail Deskripsi UMKM</h3>
        <a href="{{ route('admin.umkms.edit', $umkm->id) }}" class="btn btn-primary btn-sm ml-auto">
            <i class="fas fa-edit"></i> Edit Deskripsi
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="200">Judul</th>
                        <td>{{ $umkm->judul }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $umkm->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Banner 1</th>
                        <td class="text-center">
                            @if ($umkm->banner_1)
                                <img src="{{ asset('storage/' . $umkm->banner_1) }}" class="img-thumbnail profil-banner">
                            @else
                                <span class="text-muted">Tidak ada banner</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Banner 2</th>
                        <td class="text-center">
                            @if ($umkm->banner_2)
                                <img src="{{ asset('storage/' . $umkm->banner_2) }}" class="img-thumbnail profil-banner">
                            @else
                                <span class="text-muted">Tidak ada banner</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Banner 3</th>
                        <td class="text-center">
                            @if ($umkm->banner_3)
                                <img src="{{ asset('storage/' . $umkm->banner_3) }}" class="img-thumbnail profil-banner">
                            @else
                                <span class="text-muted">Tidak ada banner</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('css')
<style>
    .profil-banner {
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
