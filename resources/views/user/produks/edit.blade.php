@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4">
        <h2 class="text-center mb-4">Edit Produk</h2>

        <form action="{{ route('user.produks.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="mb-3">
                <label for="email" class="form-label">Pengguna</label>
                <input type="text" class="form-control" id="email" name="email" 
                    value="{{ auth()->user()->email }}" required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $produk->judul }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required>{{ $produk->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Pemilik</label>
                <input type="text" name="nama_pemilik" class="form-control" value="{{ old('nama_pemilik', $produk->nama_pemilik ?? '') }}" required>
            </div>            
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $produk->alamat }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. WhatsApp</label>
                <input type="text" name="whatsapp" class="form-control" value="{{ $produk->whatsapp }}" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required style="appearance: none; background-image: url('data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 20 20\' fill=\'gray\'><path fill-rule=\'evenodd\' d=\'M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\' clip-rule=\'evenodd\' /></svg>'); background-repeat: no-repeat; background-position: right 10px center; background-size: 16px;">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->nama_kategori }}" 
                            {{ $produk->kategori == $kategori->nama_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>                       
            <div class="mb-3">
                <label class="form-label">Link Olshop</label>
                <input type="text" name="link_olshop" class="form-control" value="{{ $produk->link_olshop }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Link Sosmed</label>
                <input type="text" name="link_sosmed" class="form-control" value="{{ $produk->link_sosmed }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Foto Produk</label>
                <input type="file" name="foto[]" class="form-control" multiple>
                @if ($produk->foto)
                    <div class="mt-2">
                        <p>Foto Lama:</p>
                        @foreach (json_decode($produk->foto, true) as $foto)
                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Produk" class="img-thumbnail me-2" width="100">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Thumbnail Produk</label>
                <input type="file" name="thumbnail" class="form-control">
                @if ($produk->thumbnail)
                    <div class="mt-2">
                        <p>Thumbnail Lama:</p>
                        <img src="{{ asset('storage/' . $produk->thumbnail) }}" alt="Thumbnail Produk" class="img-thumbnail" width="100">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.produks.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
