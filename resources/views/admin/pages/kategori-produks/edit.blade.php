@extends('adminlte::page')

@section('title', 'Edit Kategori Produk')

@section('content_header')
    <h1>Edit Kategori Produk</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
           <form action="{{ route('admin.kategori-produks.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
    </div>
    <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.kategori-produks.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
</form>

        </div>
    </div>
@endsection
