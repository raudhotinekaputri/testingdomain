@extends('layouts.app')

@section('content')
<div class="container px-lg-5 px-md-4 px-3 py-4"> {{-- Tambahin padding biar gak mepet layar --}}
    <!-- Banner Slider -->
    @if ($banners->isNotEmpty())
    <div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php $first = true; @endphp
            @foreach ($banners as $banner)
                @foreach (['banner_1', 'banner_2', 'banner_3'] as $bannerKey)
                    @if (!empty($banner->$bannerKey))
                        <div class="carousel-item {{ $first ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $banner->$bannerKey) }}" 
                                 class="d-block w-100 rounded shadow-sm" 
                                 alt="Banner">
                        </div>
                        @php $first = false; @endphp
                    @endif
                @endforeach
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#bannerCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
    @endif

    <!-- Profil UMKM -->
    <div class="text-center my-5">
        @if ($umkmProfile)
            <h2>{{ $umkmProfile->judul }}</h2>
            <p>{{ $umkmProfile->deskripsi }}</p>
        @else
            <h2>Profil UMKM Belum Tersedia</h2>
            <p>Silakan tambahkan profil UMKM melalui panel admin.</p>
        @endif
    </div>

    <!-- Produk UMKM -->
    <div class="my-5">
        <h2 class="mb-4">Produk UMKM</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 text-center shadow-sm">
                        <img src="{{ asset('storage/'.$product->thumbnail) }}" class="card-img-top img-thumbnail" alt="{{ $product->judul }}" style="width: 100%; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">{{ $product->judul }}</h6>
                            <p class="small text-muted">{{ Str::limit($product->deskripsi, 50) }}</p>
                            <a href="{{ route('produk.show', $product->id) }}" class="btn btn-sm btn-primary">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-4">Lihat Semua Produk</a>
    </div>

    <!-- Artikel / Acara -->
    <div class="my-5">
        <h2 class="mb-4">Artikel & Acara</h2>
        <div class="row g-4">
            @foreach ($acaras as $acara)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $acara->foto ? asset('storage/'.$acara->foto) : asset('images/default-image.jpg') }}" class="card-img-top" alt="{{ $acara->judul }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $acara->judul }}</h5>
                            <p class="card-text">{{ Str::limit($acara->deskripsi, 100) }}</p>
                            <a href="{{ route('acaras.show', $acara->id) }}" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('acaras.index') }}" class="btn btn-secondary mt-4">Lihat Semua Artikel</a>
    </div>
</div>
@endsection
