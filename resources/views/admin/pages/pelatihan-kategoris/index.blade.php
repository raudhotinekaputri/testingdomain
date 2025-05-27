@extends('adminlte::page')

@section('title', 'Kategori Pelatihan')

@section('content_header')
    <h1>Kategori Pelatihan</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
         <a href="{{ route('admin.pelatihan-kategoris.create') }}" class="btn btn-primary">Tambah Kategori</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr><th>Nama</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kategori)
                        <tr>
                            <td>{{ $kategori->nama }}</td>
                            <td>
                                <a href="{{ route('admin.pelatihan-kategoris.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.pelatihan-kategoris.destroy', $kategori->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">{{ $kategoris->links() }}</div>
        </div>
    </div>
@endsection
