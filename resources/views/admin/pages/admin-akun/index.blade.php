@extends('adminlte::page')

@section('title', 'Daftar Admin')

@section('content_header')
    <h1>Daftar Admin</h1>
@stop

@section('content')
    <a href="{{ route('admin.admin-akun.create') }}" class="btn btn-primary mb-3">+ Tambah Admin</a>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.admin-akun.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.admin-akun.destroy', $admin->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($admins->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada admin lain.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
