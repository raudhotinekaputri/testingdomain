@extends('adminlte::page')

@section('title', 'Kategori Acara')

@section('content_header')
    <h1>Kategori Acara</h1>
@stop

@section('content')
    <a href="{{ route('admin.kategori-acara.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Nama Kategori</th>
                            <th>Dibuat Pada</th>
                            <th style="width: 160px;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoriAcaras as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td>{{ $kategori->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.kategori-acara.edit', $kategori->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.kategori-acara.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($kategoriAcaras->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada kategori acara</td>
                            </tr>
                        @endif
                    </tbody>
                </table>              
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $kategoriAcaras->links() }}
    </div>  
@stop
