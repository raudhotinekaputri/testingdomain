@extends('adminlte::page')

@section('title', 'Peserta Pelatihan')

@section('content_header')
    <h1>Peserta Pelatihan</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
    </div>
@endif

{{-- Filter Pelatihan --}}
<form action="{{ route('admin.peserta_pelatihan.index') }}" method="GET" class="mb-4 d-flex align-items-center">
    <div class="mr-2">
        <select name="pelatihan_id" class="form-control" style="max-width: 300px;">
            <option value="">-- Semua Pelatihan --</option>
            @foreach ($pelatihans as $pelatihan)
                <option value="{{ $pelatihan->id }}" {{ request('pelatihan_id') == $pelatihan->id ? 'selected' : '' }}>
                    {{ $pelatihan->judul }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-secondary mr-2">Filter</button>

    {{-- Tombol Export PDF --}}
    <a href="{{ request('pelatihan_id') ? route('admin.peserta_pelatihan.exportPdf', request('pelatihan_id')) : '#' }}"
       class="btn btn-danger"
       @if (!request('pelatihan_id')) disabled @endif>
        Export PDF
    </a>
</form>

{{-- Tombol Tambah Peserta --}}
<a href="{{ route('admin.peserta_pelatihan.create') }}" class="btn btn-success mb-4">Tambah Peserta</a>

{{-- Tabel Peserta --}}
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Pelatihan</th>
                <th>Email</th>
                <th>Sertifikat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesertas as $peserta)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peserta->nama }}</td>
                    <td>{{ $peserta->pelatihan->judul ?? 'N/A' }}</td>
                    <td>{{ $peserta->email ?? 'N/A' }}</td>
                    <td>
                        @if ($peserta->file_sertifikat)
                            <span class="badge badge-success">Sudah</span>
                        @else
                            <span class="badge badge-danger">Belum</span>
                        @endif
                    </td>                                       
                    <td>
                        <a href="{{ route('admin.peserta_pelatihan.show', $peserta->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.peserta_pelatihan.sertifikat', $peserta->id) }}" class="btn btn-secondary btn-sm">Sertifikat</a>
                        <a href="{{ route('admin.peserta_pelatihan.edit', $peserta->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.peserta_pelatihan.destroy', $peserta->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>                        
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data peserta.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $pesertas->links() }}
</div>
@stop
