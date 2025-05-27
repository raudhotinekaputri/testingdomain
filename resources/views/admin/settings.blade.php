@extends('adminlte::page')

@section('title', 'Pengaturan Akun')

@section('content_header')
    <h1>Pengaturan Akun</h1>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-3 text-center">
                    {{-- Foto Profil --}}
                    <label for="avatar">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="img-thumbnail rounded-circle" width="150">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&size=150" class="img-thumbnail rounded-circle">
                        @endif
                    </label>
                    <input type="file" name="avatar" class="form-control mt-2" accept="image/*">
                </div>

                <div class="col-md-9">
                    {{-- Nama --}}
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                    </div>

                    {{-- Password (Opsional) --}}
                    <div class="form-group">
                        <label>Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    {{-- Tombol Simpan --}}
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
