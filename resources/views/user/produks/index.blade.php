@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow-lg" style="max-width: 800px; width: 100%;">
        <h2 class="text-center mb-4">Produk Saya</h2>
        <p class="text-center">Login sebagai: {{ auth()->user()->email ?? 'Guest' }}</p>

        <div class="row mb-3">
            <div class="col-6 ps-1">
                <a href="{{ route('user.produks.create') }}" class="btn btn-primary w-100">Tambah Produk</a>
            </div>
            <div class="col-6 pe-1">
                <a href="{{ url('user/dashboard') }}" class="btn btn-secondary w-100">Kembali</a>
            </div>
        </div>        

        @foreach ($produks as $produk)
        <div class="card mb-3 shadow-sm">
            <img src="{{ asset('storage/' . $produk->thumbnail) }}" alt="Thumbnail Produk" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
            <div class="p-3">
                <h4>{{ $produk->judul }}</h4>
                <p>{{ Str::limit($produk->deskripsi, 100) }}</p>
                <p><strong>Pemilik:</strong> {{ optional($produk->user)->email ?? 'Tidak diketahui' }}</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('user.produks.show', $produk->id) }}" class="btn btn-info btn-sm">Detail Produk</a>
                    <a href="{{ route('user.produks.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('user.produks.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus produk ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{ $produks->links() }}
    </div>
</div>
@endsection
