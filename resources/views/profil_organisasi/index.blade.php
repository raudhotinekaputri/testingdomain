@extends('layouts.app')

@section('content')
<div class="container py-5 px-3 px-md-5">

    <h1 class="text-center mb-4 fw-bold text-success">{{ $profil->judul }}</h1>

    @if($profil->banner)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $profil->banner) }}" class="img-fluid rounded" alt="Banner Organisasi">
        </div>
    @endif

    <div class="mb-5">
        <h3 class="mb-3 fw-bold text-success">Tentang Organisasi</h3>
        <p>{{ $profil->deskripsi }}</p>
    </div>

    @if($profil->visi || $profil->misi)
        <div class="mb-5">
            <h3 class="mb-3 fw-bold text-success">Visi dan Misi</h3>
            @if($profil->visi)
                <h5 class="fw-bold text-success">Visi</h5>
                <p>{{ $profil->visi }}</p>
            @endif
            @if($profil->misi)
                <h5 class="fw-bold text-success mt-3">Misi</h5>
                <p>{!! nl2br(e($profil->misi)) !!}</p> {{-- Menjaga format list --}}
            @endif
        </div>
    @endif

    @if($profil->bagan_gambar)
        <div class="mb-5 text-center">
            <h3 class="mb-3 fw-bold text-success">{{ $profil->bagan_judul }}</h3>
            <img src="{{ asset('storage/' . $profil->bagan_gambar) }}" class="img-fluid rounded mx-auto d-block" alt="Bagan Organisasi">
        </div>    
    @endif

</div>
@endsection
