@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-3">{{ $umkm->judul }}</h1>
    <p class="text-center">{{ $umkm->deskripsi }}</p>

    @foreach (['banner_1', 'banner_2', 'banner_3'] as $banner)
        @if ($umkm->$banner)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $umkm->$banner) }}" 
                     class="img-fluid w-100 rounded shadow-sm" 
                     alt="Banner UMKM">
            </div>
        @endif
    @endforeach

    <div class="text-center mt-4">
        <a href="{{ route('umkm.index') }}" class="btn btn-secondary">Kembali ke Daftar UMKM</a>
    </div>
@endsection
