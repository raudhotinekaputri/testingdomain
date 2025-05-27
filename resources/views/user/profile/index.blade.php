@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card p-4 shadow-sm mb-4" style="max-width: 100%; overflow-x: auto;">
        {{-- Tombol Kembali ke Dashboard --}}
        <div class="mb-3">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <h2 class="text-center mb-4">Profil Saya</h2>

        {{-- Foto Profil --}}
<div class="d-flex justify-content-center mb-4">
    @if($profile && $profile->profile_picture)
        <img src="{{ asset('storage/' . $profile->profile_picture) }}"
             class="rounded-circle shadow"
             style="width: 200px; height: 200px; object-fit: cover;"
             alt="Foto Profil">
    @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->nama ?? 'User') }}&background=random"
             class="rounded-circle shadow"
             style="width: 200px; height: 200px; object-fit: cover;"
             alt="Foto Profil">
    @endif
</div>

        {{-- Informasi Profil --}}
        <div class="row gy-3">
            <div class="col-md-6">
                <strong>Nama:</strong><br>{{ $profile->nama }}
            </div>
            <div class="col-md-6">
                <strong>No. WhatsApp:</strong><br>{{ $profile->no_whatsapp }}
            </div>
            <div class="col-md-6">
                <strong>Alamat:</strong><br>{{ $profile->alamat }}
            </div>
            <div class="col-md-6">
                <strong>Nama Usaha:</strong><br>{{ $profile->nama_usaha }}
            </div>
            <div class="col-md-6">
                <strong>Alamat Usaha:</strong><br>{{ $profile->alamat_usaha }}
            </div>
            <div class="col-md-6">
                <strong>Kategori Usaha:</strong><br>
                {{ $profile->kategoriUsaha->pluck('nama')->join(', ') }}
            </div>
            <div class="col-md-6">
                <strong>Nomor Izin Usaha:</strong><br>{{ $profile->nomor_izin_usaha }}
            </div>
            <div class="col-md-6">
                <strong>No. WhatsApp Usaha:</strong><br>{{ $profile->nomor_whatsapp_usaha }}
            </div>
            <div class="col-md-6">
                <strong>Link Olshop 1:</strong><br>
                <a href="{{ $profile->link_olshop_1 }}" target="_blank">{{ $profile->link_olshop_1 }}</a>
            </div>
            <div class="col-md-6">
                <strong>Link Olshop 2:</strong><br>
                <a href="{{ $profile->link_olshop_2 }}" target="_blank">{{ $profile->link_olshop_2 }}</a>
            </div>
            <div class="col-12">
                <strong>Deskripsi Usaha:</strong>
                <p class="mt-1">{{ $profile->deskripsi_usaha }}</p>
            </div>
        </div>

        {{-- Tombol Edit --}}
        <div class="text-end mt-4">
            <a href="{{ route('user.profile.edit') }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
