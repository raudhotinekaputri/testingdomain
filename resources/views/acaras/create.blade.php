@extends('adminlte::page')

@section('title', 'Tambah Acara')

@section('content_header')
    <h1>Tambah Acara</h1>
@endsection

@section('content')
    <form action="{{ route('admin.acaras.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control">
                <option value="Bazar">Bazar</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
