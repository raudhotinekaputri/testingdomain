@extends('adminlte::page')

@section('title', 'Tambah Acara')

@section('content_header')
    <h1>Tambah Acara</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.acaras.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>
                

                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="bisa_daftar">Bisa Daftar?</label>
                    <select name="bisa_daftar" id="bisa_daftar" class="form-control" required>
                        <option value="1">Ya, bisa daftar</option>
                        <option value="0" selected>Tidak, hanya posting informasi</option>
                    </select>
                </div>                

                <div class="mt-3">
    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
    <a href="{{ route('admin.acaras.index') }}" class="btn btn-secondary">Kembali</a>
</div>

            </form>
        </div>
    </div>
@stop
