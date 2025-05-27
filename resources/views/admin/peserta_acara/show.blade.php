@extends('adminlte::page')

@section('title', 'Detail Peserta Acara')

@section('content_header')
    <h1>Detail Peserta Acara</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $pesertaAcara->id }}</td>
            </tr>
            <tr>
                <th>Acara</th>
                <td>{{ $pesertaAcara->acara->judul }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $pesertaAcara->nama }}</td>
            </tr>
            <tr>
                <th>Whatsapp</th>
                <td>{{ $pesertaAcara->whatsapp }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $pesertaAcara->email }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $pesertaAcara->alamat }}</td>
            </tr>
        </table>

        <a href="{{ route('admin.peserta_acara.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
