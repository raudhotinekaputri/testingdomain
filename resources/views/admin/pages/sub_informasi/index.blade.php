@extends('adminlte::page')

@section('title', 'Kelola Sub Informasi')

@section('content_header')
    <h1>Kelola Sub Informasi</h1>
@endsection
@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Sub Informasi</h3>
        <div class="card-tools">
            <a href="{{ route('admin.sub_informasi.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Sub Informasi
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($subInformasis->isEmpty())
            <div class="alert alert-warning">Belum ada sub informasi.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Video</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subInformasis as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ Str::limit($item->deskripsi, 50, '...') }}</td>
                                <td class="text-center">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="img-thumbnail subinfo-img">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->video)
                                        <video class="subinfo-video" controls>
                                            <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                                        </video>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->dokumen)
                                        <a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fas fa-file"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.sub_informasi.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="d-flex justify-content-center">
                {{ $subInformasis->links() }}
            </div>
        @endif
    </div>
</div>

{{-- Form hapus tersembunyi --}}
<form id="form-hapus" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@section('css')
<style>
    .subinfo-img {
        width: 80px;
        height: auto;
        border-radius: 5px;
    }

    .subinfo-video {
        width: 100px;
        height: auto;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        .subinfo-img {
            width: 60px;
        }

        .subinfo-video {
            width: 80px;
        }

        .btn-sm {
            font-size: 12px;
            padding: 4px 8px;
        }
    }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.btn-hapus');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                let subInfoId = this.getAttribute('data-id');
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
                        // Gunakan URL Laravel yang sudah benar, lalu ganti :id pakai JS
                        let action = "{{ route('admin.sub_informasi.destroy', ':id') }}";
                        form.action = action.replace(':id', subInfoId);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
