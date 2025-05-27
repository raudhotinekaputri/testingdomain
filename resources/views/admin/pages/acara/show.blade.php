@extends('adminlte::page')

@section('title', 'Detail Acara')

@section('content_header')
    <h1>Detail Acara</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr><th>Judul</th><td>{{ $acara->judul }}</td></tr>
                    <tr><th>Deskripsi</th><td>{{ $acara->deskripsi }}</td></tr>
                    <tr><th>Tanggal</th><td>{{ $acara->tanggal ?? '-' }}</td></tr>
                    <tr><th>Lokasi</th><td>{{ $acara->lokasi ?? '-' }}</td></tr>
                    <tr><th>Video</th>
                        <td>
                            @if($acara->video)
                                <a href="{{ $acara->video }}" target="_blank">Lihat Video</a>
                            @else
                                Tidak ada video
                            @endif
                        </td>
                    </tr>
                    <tr><th>Foto</th>
                        <td>
                            @if($acara->foto)
                                <img src="{{ asset('storage/' . $acara->foto) }}" alt="Foto Acara" width="200">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('admin.acaras.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@endsection
