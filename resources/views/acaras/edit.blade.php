@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Acara</h1>
    <form action="{{ route('acaras.update', $acara->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Judul Acara</label>
            <input type="text" name="judul" class="form-control" value="{{ $acara->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $acara->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $acara->tanggal->format('Y-m-d') }}" required>
        </div>
        {{-- Dropdown kategori --}}
<div class="form-group">
    <label for="kategori_id">Kategori</label>
    <select name="kategori_id" id="kategori_id" class="form-control" required>
        <option value="">Pilih Kategori</option>
        @foreach($kategoriList as $kategori)
            <option value="{{ $kategori->id }}" {{ old('kategori_id', $acara->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama }}
            </option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
            @if ($acara->foto)
                <img src="{{ asset('storage/'.$acara->foto) }}" class="img-thumbnail mt-2" width="200">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
