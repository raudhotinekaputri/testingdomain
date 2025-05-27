@extends('adminlte::page')

@section('title', 'Kelola Kategori Usaha')

@section('content_header')
    <h1>Kategori Usaha</h1>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.kategori-usaha.create') }}" class="btn btn-primary">Tambah Kategori</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kategori)
                        <tr>
                            <td>{{ $kategori->nama }}</td>
                            <td>
                                <a href="{{ route('admin.kategori-usaha.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.kategori-usaha.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        {{ $kategoris->links() }}
    </div>    
@endsection
