@extends('adminlte::page')

@section('title', 'Pengaturan Akun')

@section('content_header')
    <h1>Pengaturan Akun</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
            </table>

            <a href="{{ route('admin.settings.edit') }}" class="btn btn-primary mt-3">Edit Akun</a>
        </div>
    </div>
@stop
