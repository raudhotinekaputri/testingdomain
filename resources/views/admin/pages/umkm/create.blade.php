@extends('admin.layouts.app')

@section('content')
    <h1>Tambah UMKM</h1>
    <form action="{{ route('admin.umkms.store') }}" method="POST" enctype="multipart/form-data">
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
            <label>Banner 1</label>
            <input type="file" name="banner_1" class="form-control">
        </div>
        <div class="form-group">
            <label>Banner 2</label>
            <input type="file" name="banner_2" class="form-control">
        </div>
        <div class="form-group">
            <label>Banner 3</label>
            <input type="file" name="banner_3" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
