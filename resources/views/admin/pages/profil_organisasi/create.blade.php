@extends('admin.layouts.app')

@section('content')
    <h1>Tambah Profil Organisasi</h1>
    <form action="{{ route('admin.profil_organisasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Banner</label>
            <input type="file" name="banner" class="form-control">
        </div>
        <div class="form-group">
            <label>Bagan Judul</label>
            <input type="text" name="bagan_judul" class="form-control">
        </div>
        <div class="form-group">
            <label>Bagan Gambar</label>
            <input type="file" name="bagan_gambar" class="form-control">
        </div>
        <div class="form-group">
            <label>Visi</label>
            <textarea name="visi" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Misi</label>
            <textarea name="misi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
