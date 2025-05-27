@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $informasi->judul }}</h1>
    <p>{{ $informasi->deskripsi }}</p>

    @if($informasi->gambar)
        <img src="{{ asset('storage/' . $informasi->gambar) }}" width="400">
    @endif
    <br>
    <br>
    <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Kembali ke Informasi</a>
</div>
@endsection
