@extends('adminlte::page')

@section('title', 'Kelola Footer')

@section('content_header')
    <h1>Edit Footer</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('admin.footer.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="tentang_umkm" class="form-label">Tentang UMKM</label>
                            <textarea name="tentang_umkm" class="form-control" rows="4" required>{{ $footer->tentang_umkm ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $footer->alamat ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $footer->email ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="{{ $footer->telepon ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{ $footer->facebook ?? '#' }}">
                        </div>

                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control" value="{{ $footer->twitter ?? '#' }}">
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control" value="{{ $footer->instagram ?? '#' }}">
                        </div>

                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" value="{{ $footer->linkedin ?? '#' }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
