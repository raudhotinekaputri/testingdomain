@extends('adminlte::page')

@section('title', 'Kelola Produk')

@section('content_header')
    <h1>Kelola Produk</h1>
@stop

@section('content')

{{-- Notifikasi Sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="{{ route('admin.produks.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

<!-- Tombol Export PDF -->
<form action="{{ route('admin.produk.export') }}" method="GET">
    <button type="submit" class="btn btn-success mb-3">Export to PDF</button>
</form>

<!-- Filter Produk -->
<form action="{{ route('admin.produks.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Produk</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Pemilik</th>
                        <th>Alamat</th>
                        <th>WhatsApp</th>
                        <th>Nama Olshop</th>
                        <th>Sosial Media</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $index => $produk)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($produk->thumbnail)
                                    <img src="{{ asset('storage/' . $produk->thumbnail) }}" class="img-thumbnail" width="100">
                                @else
                                    <span class="text-muted">Tidak ada thumbnail</span>
                                @endif
                            </td>
                            <td>{{ $produk->judul }}</td>
                            <td>{{ Str::limit($produk->deskripsi, 50, '...') }}</td>
                            <td>{{ $produk->nama_pemilik }}</td>
                            <td>{{ $produk->alamat }}</td>
                            <td>{{ $produk->whatsapp }}</td>
                            <td>
                                @if ($produk->link_olshop)
                                    <a href="{{ $produk->link_olshop }}" target="_blank" class="text-primary">Olshop</a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                @if ($produk->link_sosmed)
                                    <a href="{{ $produk->link_sosmed }}" target="_blank" class="text-primary">Sosmed</a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.produks.edit', $produk->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                <form action="{{ route('admin.produks.destroy', $produk->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-3">
    {!! $produks->withQueryString()->links('pagination::bootstrap-5') !!}
</div>

@stop
