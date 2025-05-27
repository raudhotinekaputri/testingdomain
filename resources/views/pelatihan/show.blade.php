@extends('layouts.app')

@section('title', 'Detail Pelatihan')

@section('content')
<div class="container mt-4" style="max-width: 800px;">
    <h2 class="mb-4 fw-bold text-center">{{ $pelatihan->judul }}</h2>

    <div class="card shadow-sm">

        {{-- Foto Pelatihan --}}
        @if ($pelatihan->foto)
            <div class="d-flex justify-content-center p-3">
                <img src="{{ asset('storage/' . $pelatihan->foto) }}" 
                     alt="Foto Pelatihan" 
                     class="img-fluid rounded" 
                     style="max-width: 100%; height: auto;">
            </div>
        @endif

        <div class="card-body p-4">

            {{-- Informasi Pelatihan --}}
            <p class="mb-3"><strong>Deskripsi:</strong><br>{!! nl2br(e($pelatihan->deskripsi)) !!}</p>

            <p class="mb-3"><strong>Kategori:</strong> {{ $pelatihan->kategori->nama ?? '-' }}</p>

            <p class="mb-3">
                <strong>Jadwal:</strong> 
                {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }} 
                | {{ $pelatihan->jam }}
            </p>

            <p class="mb-3"><strong>Lokasi:</strong> {{ $pelatihan->lokasi }}</p>

            <p class="mb-3"><strong>Tipe:</strong> {{ ucfirst($pelatihan->tipe) }}</p>

            <p class="mb-4"><strong>Penyelenggara:</strong> {{ $pelatihan->penyelenggara }}</p>

           {{-- Tombol Daftar --}}
           <div class="d-flex gap-2 mt-3">
            @if($pelatihan->khusus_umkm_patikraja)
                @if(auth()->check())
                    @if($sudahDaftar)
                        <button class="btn btn-secondary flex-fill" disabled>Sudah Terdaftar</button>
                    @else
                        <form action="{{ route('pelatihan_peserta.create', $pelatihan->id) }}" method="GET" class="flex-fill">
                            <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('user.login', ['redirect' => route('pelatihans.show', $pelatihan->id)]) }}" 
                       class="btn btn-warning flex-fill">
                       Login untuk Daftar
                    </a>
                @endif
            @else
                <form action="{{ route('pelatihan_peserta.create', $pelatihan->id) }}" method="GET" class="flex-fill">
                    <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                </form>
            @endif
        
            {{-- Tombol Kembali --}}
            <a href="{{ route('pelatihans.index') }}" class="btn btn-secondary flex-fill">Kembali</a>
        </div>
        

            {{-- Info Khusus --}}
            @if($pelatihan->khusus_umkm_patikraja)
                <div class="alert alert-warning mt-3">
                    Pelatihan ini khusus untuk UMKM Patikraja.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
