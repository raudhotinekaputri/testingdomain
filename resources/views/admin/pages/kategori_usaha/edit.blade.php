@extends('adminlte::page')

@section('title', 'Edit Kategori Usaha')

@section('content_header')
    <h1>Edit Kategori Usaha</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('admin.kategori-usaha.update', $kategori_usaha->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kategori</label>
                     <input type="text" class="form-control" id="nama" name="nama" value="{{ $kategori_usaha->nama }}" required>
                </div>
                <div class="mt-3 d-flex">
                    <button type="submit" class="btn btn-primary me-3">Update</button>
                    <a href="{{ route('admin.kategori-usaha.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
