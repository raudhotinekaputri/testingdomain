@extends('layouts.app')

@section('content')
    <h1>UMKM Patikraja</h1>
    <div class="row">
        @foreach ($umkms as $umkm)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if ($umkm->banner_1)
                        <img src="{{ asset('storage/' . $umkm->banner_1) }}" 
                             class="card-img-top" 
                             alt="Banner UMKM" 
                             style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $umkm->judul }}</h5>
                        <p class="card-text">{{ Str::limit($umkm->deskripsi, 100) }}</p>
                        <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
