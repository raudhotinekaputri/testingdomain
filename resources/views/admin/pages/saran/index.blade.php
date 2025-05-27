@extends('adminlte::page')

@section('title', 'Daftar Saran')

@section('content_header')
    <h1>Daftar Saran</h1>
@stop

@section('content')

@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Saran Pengunjung</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-wrap">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Isi Saran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sarans as $index => $saran)
                        <tr style="background-color: {{ $saran->is_read ? 'lightgreen' : 'lightcoral' }};">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td style="word-break: break-word;">{{ $saran->email }}</td>
                            <td style="word-break: break-word;">{{ Str::limit($saran->isi, 100, '...') }}</td>
                            <td class="text-center">{{ $saran->is_read ? 'Sudah Ditangani' : 'Belum Ditangani' }}</td>
                            <td class="text-center">
                                <form action="{{ route('saran.show', $saran->id) }}" method="GET" class="d-inline">
                                    <button type="submit" class="btn btn-info btn-sm">Detail</button>
                                </form>                                
                                <form action="{{ route('saran.destroy', $saran->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus saran ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada saran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">
    {{ $sarans->links() }}
</div>
@stop
