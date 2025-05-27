@extends('adminlte::page')

@section('title', 'Edit Footer')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Update Footer Information</h2>

        <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label for="tentang_umkm" class="form-label">Tentang UMKM</label>
                <textarea class="form-control" id="tentang_umkm" name="tentang_umkm" rows="4">{{ old('tentang_umkm', $footer->tentang_umkm ?? '-') }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $footer->alamat ?? '-') }}">
            </div>

            <div class="form-group mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $footer->email ?? '-') }}">
            </div>

            <div class="form-group mb-4">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $footer->telepon ?? '-') }}">
            </div>

            <div class="form-group mb-4">
                <label for="facebook" class="form-label">Facebook URL</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $footer->facebook ?? '-') }}">
            </div>

            <div class="form-group mb-4">
                <label for="twitter" class="form-label">Twitter URL</label>
                <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $footer->twitter ?? '-') }}">
            </div>

            <div class="form-group mb-4">
                <label for="instagram" class="form-label">Instagram URL</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $footer->instagram ?? '-') }}">
            </div>

            <div class="form-group mb-4">
                <label for="linkedin" class="form-label">LinkedIn URL</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin', $footer->linkedin ?? '-') }}">
            </div>

            <button type="submit" class="btn btn-primary mt-4">Update Footer</button>
        </form>

        <a href="{{ route('admin.footer.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
