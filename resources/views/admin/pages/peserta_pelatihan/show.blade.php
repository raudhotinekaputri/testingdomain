@extends('adminlte::page')

@section('title', 'Detail Peserta Pelatihan')

@section('content_header')
    <h1>Detail Peserta Pelatihan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr><th>Nama</th><td>{{ $peserta->nama }}</td></tr>
                    <tr><th>Email</th><td>{{ $peserta->email ?? '-' }}</td></tr>
                    <tr>
                        <th>Nomor WhatsApp</th>
                        <td>
                            @if($peserta->whatsapp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $peserta->whatsapp) }}" target="_blank">
                                    {{ $peserta->whatsapp }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr><th>Nama Usaha</th><td>{{ $peserta->nama_usaha ?? '-' }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $peserta->alamat ?? '-' }}</td></tr>
                    <tr><th>Pelatihan</th><td>{{ $peserta->pelatihan->judul ?? '-' }}</td></tr>
                    <tr><th>Tanggal Daftar</th><td>{{ $peserta->created_at->format('d M Y') }}</td></tr>
                </tbody>
            </table>
            <a href="{{ route('admin.peserta_pelatihan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@stop
