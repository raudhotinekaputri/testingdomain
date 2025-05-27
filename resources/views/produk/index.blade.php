@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container py-4 px-3 px-md-5">
    <h1 class="mb-4">Daftar Produk</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Pencarian --}}
    <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    {{-- Daftar Produk --}}
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($produks as $produk)
            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <a href="{{ route('produk.show', $produk->id) }}" class="text-decoration-none text-dark">
                        <img src="{{ asset('storage/' . ($produk->thumbnail ?? 'default.jpg')) }}"
                             class="card-img-top img-thumbnail"
                             alt="{{ $produk->judul }}"
                             style="width: 100%; height: 150px; object-fit: cover;">

                        <div class="card-body">
                            <h6 class="card-title">{{ $produk->judul }}</h6>
                            <p class="small text-muted">{{ Str::limit($produk->deskripsi, 50) }}</p>
                            <button class="btn btn-sm btn-primary">Lihat Produk</button>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">Produk tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>

    {{-- Pagination --}}
    {{-- Pagination --}}
<div class="container mt-4">
    <div class="row align-items-center">
        <div class="col-md-6 text-start">
            <small class="text-muted">
                Menampilkan {{ $produks->firstItem() }} - {{ $produks->lastItem() }} dari total {{ $produks->total() }} produk
            </small>
        </div>
        <div class="col-md-6 text-end">
            {{ $produks->links() }}
        </div>
    </div>
</div>

    
@endsection
