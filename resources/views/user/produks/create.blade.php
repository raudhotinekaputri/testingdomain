@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4">
        <h2 class="text-center mb-4">Tambah Produk</h2>

        <form action="{{ route('user.produks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Pengguna</label>
                <input type="text" class="form-control" id="email" name="email" 
                    value="{{ auth()->user()->email }}" required readonly>
            </div>
            
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Produk</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>

            <div class="mb-3">
                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" 
                    value="{{ old('nama_pemilik', $produk->nama_pemilik ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>

            <div class="mb-3">
                <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
            </div>

            <div class="mb-3">
                <label for="link_olshop" class="form-label">Link Olshop</label>
                <input type="text" class="form-control" id="link_olshop" name="link_olshop" 
                    value="{{ old('link_olshop', $produk->link_olshop ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="link_sosmed" class="form-label">Link Sosmed</label>
                <input type="text" class="form-control" id="link_sosmed" name="link_sosmed" 
                    value="{{ old('link_sosmed', $produk->link_sosmed ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Upload Foto (Maks 5)</label>
                <input type="file" class="form-control" id="foto" name="foto[]" multiple accept="image/*">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('user.produks.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
