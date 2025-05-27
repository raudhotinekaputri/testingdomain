@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow-lg" style="max-width: 900px; width: 100%;">
        <h2 class="text-center mb-4">{{ $produk->judul }}</h2>
        
        <!-- Thumbnail dan Foto Produk -->
        <div class="d-flex flex-column">
            <!-- Thumbnail -->
            @if($produk->thumbnail)
            <div class="mb-3">
                <h5 class="text-center">Thumbnail</h5>
                <div class="thumbnail-box text-center">
                    <img src="{{ asset('storage/' . $produk->thumbnail) }}" alt="Thumbnail Produk" class="img-thumbnail">
                </div>
            </div>
            @endif

            <!-- Foto Produk -->
            @if(!empty($produk->fotoproduks) && $produk->fotoproduks->count() > 0)
            <div>
                <h5 class="text-center">Foto Produk</h5>
                <div class="foto-produk-grid">
                    @foreach($produk->fotoproduks as $foto)
                        <div class="foto-item">
                            <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Produk" class="img-thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <table class="table mt-3">
            <tr><th>Deskripsi</th><td>{{ $produk->deskripsi }}</td></tr>
            <tr><th>Nama Pemilik</th><td>{{ $produk->nama_pemilik }}</td></tr>
            <tr><th>Alamat</th><td>{{ $produk->alamat }}</td></tr>
            <tr><th>WhatsApp</th><td>{{ $produk->whatsapp }}</td></tr>
            <tr><th>Link Olshop</th><td><a href="{{ $produk->link_olshop }}" target="_blank">{{ $produk->link_olshop }}</a></td></tr>
            <tr><th>Link Sosmed</th><td><a href="{{ $produk->link_sosmed }}" target="_blank">{{ $produk->link_sosmed }}</a></td></tr>
        </table>

        <div class="d-flex justify-content-between">
            <a href="{{ route('user.produks.index') }}" class="btn btn-secondary">Kembali</a>
            <div>
                <a href="{{ route('user.produks.edit', $produk->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('user.produks.destroy', $produk->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
