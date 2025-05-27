@extends('adminlte::page')

@section('title', 'Edit Profil Organisasi')

@section('content_header')
    <h1>Edit Profil Organisasi</h1>
@stop

@section('content')

{{-- Notifikasi Error --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.profil_organisasi.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')    

            {{-- Judul --}}
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $profil->judul) }}">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
            </div>

           {{-- Banner --}}
<div class="mb-3">
    <label class="form-label">Banner (Opsional)</label>
    <input type="file" name="banner" class="form-control">
    @if($profil->banner)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $profil->banner) }}" class="img-thumbnail" width="200px">
        </div>
        <!-- Tombol Hapus untuk Banner -->
        <button type="submit" name="hapus_banner" value="hapus" class="btn btn-danger mt-2">Hapus Banner</button>
    @else
        <p class="text-muted">Belum ada banner</p>
    @endif
</div>

            {{-- Judul Bagan Organisasi --}}
            <div class="mb-3">
                <label class="form-label">Judul Bagan Organisasi</label>
                <input type="text" name="bagan_judul" class="form-control" value="{{ old('bagan_judul', $profil->bagan_judul) }}">
            </div>

            {{-- Bagan Organisasi --}}
<div class="mb-3">
    <label class="form-label">Bagan Organisasi (Gambar)</label>
    <input type="file" name="bagan_gambar" class="form-control">
    @if($profil->bagan_gambar)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $profil->bagan_gambar) }}" class="img-thumbnail" width="200px">
        </div>
        <!-- Tombol Hapus untuk Bagan Organisasi -->
        <button type="submit" name="hapus_bagan" value="hapus" class="btn btn-danger mt-2">Hapus Bagan</button>
    @else
        <p class="text-muted">Belum ada bagan organisasi</p>
    @endif
</div>

            {{-- Visi --}}
            <div class="mb-3">
                <label class="form-label">Visi</label>
                <input type="text" name="visi" class="form-control" value="{{ old('visi', $profil->visi) }}">
            </div>

            {{-- Misi --}}
            <div class="mb-3">
                <label class="form-label">Misi</label>
                <textarea name="misi" class="form-control" rows="4">{{ old('misi', $profil->misi) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.profil_organisasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@stop
