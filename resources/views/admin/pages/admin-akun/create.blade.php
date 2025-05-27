@extends('adminlte::page')

@section('title', 'Tambah Admin')

@section('content_header')
    <h1>Tambah Admin</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.admin-akun.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

               <div class="mt-3">
    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
    <a href="{{ route('admin.admin-akun.index') }}" class="btn btn-secondary">Kembali</a>
</div>

            </form>
        </div>
    </div>
@stop
