@extends('adminlte::page')

@section('title', 'Detail Pelatihan')

@section('content_header')
    <h1>Detail Pelatihan</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr><th>Judul</th><td>{{ $pelatihan->judul }}</td></tr>
                    <tr><th>Deskripsi</th><td>{{ $pelatihan->deskripsi }}</td></tr>
                    <tr><th>Kategori</th><td>{{ $pelatihan->kategori->nama ?? '-' }}</td></tr>
                    <tr><th>Jam</th><td>{{ $pelatihan->jam }}</td></tr>
                    <tr><th>Tipe</th><td>{{ ucfirst($pelatihan->tipe) }}</td></tr>
                    <tr><th>Lokasi</th><td>{{ $pelatihan->lokasi ?? '-' }}</td></tr>
                    <tr><th>Tanggal Mulai</th><td>{{ $pelatihan->tanggal_mulai ?? '-' }}</td></tr>
                    <tr><th>Tanggal Selesai</th><td>{{ $pelatihan->tanggal_selesai ?? '-' }}</td></tr>
                    <tr><th>Penyelenggara</th><td>{{ $pelatihan->penyelenggara }}</td></tr>
                    <tr>
                        <th>Khusus UMKM Patikraja</th>
                        <td>{{ $pelatihan->khusus_umkm_patikraja ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                    <tr>
                        <th>Foto</th>
                        <td>
                            @if($pelatihan->foto)
                                <img src="{{ asset('storage/' . $pelatihan->foto) }}" alt="Foto Pelatihan" width="200">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('admin.pelatihans.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@endsection
