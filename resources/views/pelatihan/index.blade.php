@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Pelatihan UMKM')

@section('content')
<div class="container py-4">
    <div class="mx-auto" style="max-width: 1140px;">
        <h1 class="text-center mb-4 font-weight-bold">PELATIHAN UMKM</h1>

        <div class="mb-4">
            <form action="{{ route('pelatihans.index') }}" method="GET" class="d-flex flex-wrap gap-2 align-items-center">
                <!-- Filter Status Pelatihan -->
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="soon" {{ request('status') == 'soon' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Selesai</option>
                </select>

                <!-- Filter Kategori -->
                <select name="kategori" class="form-control">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $id => $kategori)
                        <option value="{{ $id }}" {{ request('kategori') == $id ? 'selected' : '' }}>
                            {{ ucfirst($kategori) }}
                        </option>
                    @endforeach
                </select>

                <!-- Filter Jadwal -->
                <input type="date" name="jadwal" class="form-control" value="{{ request('jadwal') }}">

                <!-- Filter Tipe -->
                <select name="tipe" class="form-control">
                    <option value="">Semua Tipe</option>
                    <option value="online" {{ request('tipe') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ request('tipe') == 'offline' ? 'selected' : '' }}>Offline</option>
                    <option value="hybrid" {{ request('tipe') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success">Filter</button>
            </form>
        </div>

        <div class="row">
            @forelse ($semuaPelatihan as $pelatihan)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        @if ($pelatihan->foto)
                            <img src="{{ asset('storage/' . $pelatihan->foto) }}" class="card-img-top" alt="Pelatihan">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title font-weight-bold">{{ $pelatihan->judul }}</h5>
                            <p class="card-text">{{ Str::limit($pelatihan->deskripsi, 100) }}</p>

                            <p><strong>Kategori:</strong> {{ $pelatihan->kategori->nama ?? 'Tidak Diketahui' }}</p>

                            <p>
                                <strong>Jenis:</strong>
                                <span class="badge bg-info">
                                    {{ ucfirst($pelatihan->jenis) }}
                                </span>
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('pelatihans.show', $pelatihan->id) }}" class="btn btn-primary">Detail Pelatihan</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Tidak ada pelatihan tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
