@extends('layouts.app')

@section('title', $produk->judul)

@section('content')
<div class="container mt-4 px-5"> 
    <h1>{{ $produk->judul }}</h1>
    <p>{!! nl2br(e($produk->deskripsi)) !!}</p>
    <p><strong>Pemilik:</strong> {{ $produk->nama_pemilik }}</p>
    <p><strong>Alamat:</strong> {{ $produk->alamat }}</p>
    <p><strong>WhatsApp:</strong> 
        @if ($produk->whatsapp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $produk->whatsapp) }}" target="_blank" class="btn btn-success btn-sm">
                <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
            </a>
        @else
            <span class="text-muted">Tidak tersedia</span>
        @endif
    </p>    
    @if ($produk->link_olshop)
        <p><strong>Link Olshop:</strong> <a href="{{ $produk->link_olshop }}" target="_blank">Klik di sini</a></p>
    @endif

    @if ($produk->link_sosmed)
        <p><strong>Link Sosmed:</strong> <a href="{{ $produk->link_sosmed }}" target="_blank">Klik di sini</a></p>
    @endif

    @if ($produk->fotoProduks->count() > 0)
        <h5 class="mt-4">Foto Produk</h5>
        <div class="row row-cols-3 row-cols-md-4 g-3"> 
            @foreach ($produk->fotoProduks as $foto)
                <div class="col mb-4"> 
                    <div style="position: relative; width: 100%; padding-top: 133.33%; overflow: hidden; border-radius: 0.5rem; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
                        <img src="{{ asset('storage/' . $foto->foto) }}" 
                             class="img-thumbnail"
                             alt="Foto Produk"
                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; cursor: pointer;"
                             data-bs-toggle="modal" 
                             data-bs-target="#fotoModal" 
                             onclick="showFoto('{{ asset('storage/' . $foto->foto) }}')">
                    </div>
                </div>
            @endforeach
        </div>       
    @else
        <p><em>Tidak ada foto produk</em></p>
    @endif

    <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

<!-- Modal untuk Menampilkan Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoModalLabel">Detail Foto Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalFoto" src="" class="img-fluid" alt="Foto Produk">
            </div>
        </div>
    </div>
</div>

<script>
    function showFoto(src) {
        document.getElementById('modalFoto').src = src;
    }
</script>
@endsection
