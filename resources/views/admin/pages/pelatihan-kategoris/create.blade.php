@extends('adminlte::page')

@section('title', 'Tambah Kategori Pelatihan')

@section('content_header')
    <h1>Tambah Kategori</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pelatihan-kategoris.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mt-3">
                       <button type="submit" class="btn btn-primary">Simpan</button>
                      <a href="{{ route('admin.pelatihan-kategoris.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
            </form>
        </div>
    </div>
@endsection
