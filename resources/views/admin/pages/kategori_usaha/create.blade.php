@extends('adminlte::page')

@section('title', 'Tambah Kategori Usaha')

@section('content_header')
    <h1>Tambah Kategori Usaha</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.kategori-usaha.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                 <div class=" mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kategori-usaha.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
