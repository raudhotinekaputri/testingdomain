@extends('adminlte::page')

@section('title', 'Tambah Produk')

@section('content_header')
    <h1>Tambah Produk</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.produks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="user_id" class="form-label">User (Opsional)</label>
                    <select class="form-control" id="user_id" name="user_id">
                        <option value="">Tanpa User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
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
                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
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
                    <label class="form-label">Link Olshop</label>
                    <input type="text" name="link_olshop" class="form-control" value="{{ old('link_olshop', $produk->link_olshop ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Link Sosmed</label>
                    <input type="text" name="link_sosmed" class="form-control" value="{{ old('link_sosmed', $produk->link_sosmed ?? '') }}">
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
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>                

                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto (Maks 5)</label>
                    <input type="file" name="foto[]" class="form-control" multiple accept="image/*">
                </div>

              <div class="mb-3">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.produks.index') }}" class="btn btn-secondary">Kembali</a>
</div>
            </form>
        </div>
    </div>
@endsection
