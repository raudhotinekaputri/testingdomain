@extends('adminlte::page')

@section('title', 'Edit Kategori Pelatihan')

@section('content_header')
    <h1>Edit Kategori</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pelatihan-kategoris.update', $pelatihan_kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" value="{{ old('nama', $pelatihan_kategori->nama) }}" class="form-control" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.pelatihan-kategoris.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
