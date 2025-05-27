@extends('adminlte::page')

@section('title', 'Edit UMKM')

@section('content_header')
    <h1>Edit UMKM</h1>
@stop

@section('content')
    <form action="{{ route('admin.umkms.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $umkm->judul }}" required>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $umkm->deskripsi }}</textarea>
        </div>

       <!-- Banner 1 -->
<div class="form-group">
    <label>Banner 1 (1500x500 px)</label>
    <input type="file" name="banner_1" class="form-control" accept="image/*">
    @if ($umkm->banner_1)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $umkm->banner_1) }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
            <!-- Tombol hapus -->
            <button type="submit" name="remove_banner_1" value="1" class="btn btn-danger btn-sm mt-2">Hapus Banner 1</button>
        </div>
    @endif
</div>

<!-- Banner 2 -->
<div class="form-group">
    <label>Banner 2 (1500x500 px)</label>
    <input type="file" name="banner_2" class="form-control" accept="image/*">
    @if ($umkm->banner_2)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $umkm->banner_2) }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
            <!-- Tombol hapus -->
            <button type="submit" name="remove_banner_2" value="1" class="btn btn-danger btn-sm mt-2">Hapus Banner 2</button>
        </div>
    @endif
</div>

<!-- Banner 3 -->
<div class="form-group">
    <label>Banner 3 (1500x500 px)</label>
    <input type="file" name="banner_3" class="form-control" accept="image/*">
    @if ($umkm->banner_3)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $umkm->banner_3) }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
            <!-- Tombol hapus -->
            <button type="submit" name="remove_banner_3" value="1" class="btn btn-danger btn-sm mt-2">Hapus Banner 3</button>
        </div>
    @endif
</div>

{{-- Tombol Submit --}}
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('admin.umkms.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@stop
