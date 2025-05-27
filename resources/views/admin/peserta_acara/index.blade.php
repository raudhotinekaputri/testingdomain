@extends('adminlte::page')

@section('title', 'Daftar Peserta Acara')

@section('content_header')
    <h1>Daftar Peserta Acara</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.peserta_acara.create') }}" class="btn btn-primary mb-3">Tambah Peserta</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.peserta_acara.index') }}" method="GET" class="mb-3">
            <div class="form-row align-items-end">
                <div class="col-md-4">
                    <label for="acara_id">Filter Acara</label>
                    <select name="acara_id" id="acara_id" class="form-control">
                        <option value="">-- Semua Acara --</option>
                        @foreach($acaras as $acara)
                            <option value="{{ $acara->id }}" {{ request('acara_id') == $acara->id ? 'selected' : '' }}>
                                {{ $acara->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4 w-100">Terapkan</button>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('admin.peserta_acara.download', ['acara_id' => request('acara_id')]) }}"
                       class="btn btn-success mt-4 w-100"
                       @if (!request('acara_id')) disabled @endif>
                        Download PDF
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Acara</th>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertaAcara as $peserta)
                        <tr>
                            <td>{{ $peserta->id }}</td>
                            <td>{{ $peserta->acara->judul }}</td>
                            <td>{{ $peserta->nama }}</td>
                            <td>{{ $peserta->whatsapp }}</td>
                            <td>{{ $peserta->email }}</td>
                            <td>
                                <a href="{{ route('admin.peserta_acara.show', $peserta->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('admin.peserta_acara.edit', $peserta->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.peserta_acara.destroy', $peserta->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus peserta ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
