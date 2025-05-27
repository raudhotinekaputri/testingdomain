@extends('adminlte::page')

@section('title', 'Daftar Pelatihan')

@section('content_header')
    <h1>Daftar Pelatihan</h1>
@endsection

@section('content')
    <a href="{{ route('admin.pelatihans.create') }}" class="btn btn-success mb-3">Tambah Pelatihan</a>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelatihans as $key => $pelatihan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pelatihan->judul }}</td>
                            <td>{{ $pelatihan->kategori->nama ?? 'Tidak ada kategori' }}</td>
                            <td>{{ date('d M Y', strtotime($pelatihan->tanggal_mulai)) }} - {{ date('d M Y', strtotime($pelatihan->tanggal_selesai)) }}</td>
                            <td>{{ ucfirst($pelatihan->tipe) }}</td>
                            <td>
                                <a href="{{ route('admin.pelatihans.show', $pelatihan->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('admin.pelatihans.edit', $pelatihan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.pelatihans.destroy', $pelatihan->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus pelatihan ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        {{ $pelatihans->links() }}
    </div>
</div>

@endsection
