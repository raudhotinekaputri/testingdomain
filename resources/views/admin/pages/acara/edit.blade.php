@extends('adminlte::page')

@section('title', 'Edit Acara')

@section('content_header')
    <h1>Edit Acara</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.acaras.update', $acara->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Acara</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $acara->judul) }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $acara->deskripsi) }}</textarea>
            </div>

            {{-- Gambar Lama --}}
            <div class="mb-3">
                <label class="form-label">Gambar Lama</label>
                <div>
                    @if ($acara->foto)
                        <img src="{{ asset('storage/'.$acara->foto) }}" class="img-thumbnail" style="width: 200px; height: auto;">
                        <!-- Tombol Hapus untuk Gambar Lama -->
                        <button type="submit" name="hapus_foto" value="hapus" class="btn btn-danger mt-2">Hapus Gambar</button>
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </div>
            </div>

            {{-- Upload Gambar Baru --}}
            <div class="mb-3">
                <label for="foto" class="form-label">Upload Gambar Baru</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                <small class="text-muted">Format gambar: JPG, PNG, maksimal 2MB.</small>
            </div>

           {{-- Tanggal Mulai --}}
<div class="mb-3">
    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
        value="{{ old('tanggal_mulai', $acara->tanggal_mulai->format('Y-m-d')) }}" required>
</div>

{{-- Tanggal Selesai --}}
<div class="mb-3">
    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
        value="{{ old('tanggal_selesai', $acara->tanggal_selesai->format('Y-m-d')) }}" required>
</div>



            {{-- Kategori --}}
            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori Acara</label>
                <select name="kategori_id" id="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $acara->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="bisa_daftar" class="form-label">Bisa Daftar?</label>
                <select name="bisa_daftar" id="bisa_daftar" class="form-control" required>
                    <option value="1" {{ old('bisa_daftar', $acara->bisa_daftar) == 1 ? 'selected' : '' }}>Ya, bisa daftar</option>
                    <option value="0" {{ old('bisa_daftar', $acara->bisa_daftar) == 0 ? 'selected' : '' }}>Tidak, hanya posting informasi</option>
                </select>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.acaras.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@stop
