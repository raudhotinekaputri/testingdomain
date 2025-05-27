@extends('adminlte::page')

@section('title', 'Kelola Acara')

@section('content_header')
    <h1>Kelola Acara</h1>
@stop

@section('content')

{{-- Notifikasi Sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="{{ route('admin.acaras.create') }}" class="btn btn-primary mb-3">Tambah Acara</a>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($acaras as $index => $acara)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">
                        @if ($acara->foto)
                            <img src="{{ asset('storage/'.$acara->foto) }}" class="img-thumbnail acara-img">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $acara->judul }}</td>
                    <td>{{ Str::limit($acara->deskripsi, 50, '...') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.acaras.edit', $acara->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.acaras.show', $acara->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                        <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $acara->id }}">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada acara.</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
</div>

{{-- Pagination --}}
{{ $acaras->links() }}

{{-- Form hapus tersembunyi --}}
<form id="form-hapus" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@stop

@section('css')
<style>
    .table-responsive {
        overflow-x: auto;
        white-space: nowrap;
    }

    .acara-img {
        width: 80px;
        height: auto;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        .acara-img {
            width: 60px;
        }

        .btn-sm {
            font-size: 12px;
            padding: 3px 6px;
        }
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.btn-hapus');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                let acaraId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('form-hapus');
                        form.action = `/admin/acaras/${acaraId}`;
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@stop
