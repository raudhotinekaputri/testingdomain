@extends('adminlte::page')

@section('title', 'Edit Peserta Acara')

@section('content_header')
    <h1>Edit Peserta Acara</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.peserta_acara.update', $pesertaAcara->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="acara_id">Acara</label>
                <select name="acara_id" id="acara_id" class="form-control @error('acara_id') is-invalid @enderror">
                    @foreach ($acaras as $acara)
                        <option value="{{ $acara->id }}" {{ $pesertaAcara->acara_id == $acara->id ? 'selected' : '' }}>
                            {{ $acara->judul }}
                        </option>
                    @endforeach
                </select>
                @error('acara_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pesertaAcara->nama) }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="whatsapp">Whatsapp</label>
                <input type="text" name="whatsapp" id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', $pesertaAcara->whatsapp) }}">
                @error('whatsapp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pesertaAcara->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $pesertaAcara->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.peserta_acara.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
