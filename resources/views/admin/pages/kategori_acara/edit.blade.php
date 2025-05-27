@extends('adminlte::page')

@section('title', 'Edit Kategori Acara')

@section('content_header')
    <h1>Edit Kategori Acara</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.kategori-acara.update', $kategoriAcara->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" value="{{ $kategoriAcara->nama }}" required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.kategori-acara.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
