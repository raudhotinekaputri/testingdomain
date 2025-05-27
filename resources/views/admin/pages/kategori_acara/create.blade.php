@extends('adminlte::page')

@section('title', 'Tambah Kategori Acara')

@section('content_header')
    <h1>Tambah Kategori Acara</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.kategori-acara.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" required placeholder="Contoh: Pelatihan">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.kategori-acara.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@stop
