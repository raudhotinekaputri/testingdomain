@extends('adminlte::page')

@section('title', 'Kelola User')

@section('content_header')
    <h1>Kelola User</h1>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card-header">
    <div class="d-flex flex-wrap align-items-center gap-2">
        <!-- Form Pencarian & Export -->
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari email..." class="form-control" style="width: 200px;">
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>

        <!-- Form Export PDF -->
        <form action="{{ route('admin.users.export-pdf') }}" method="GET" class="d-flex gap-2">
            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            <button type="submit" class="btn btn-danger">Export PDF</button>
        </form>
    </div>
</div>


<div class="card-body">
    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>No. WhatsApp</th>
                        <th>Nama Usaha</th>
                        <th>Status Profil</th>
                        <th>Status Email Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->profile->nama ?? 'Tidak ada profil' }}</td>
                            <td>{{ $user->profile->no_whatsapp ?? 'Tidak ada nomor WA' }}</td>
                            <td>{{ $user->profile->nama_usaha ?? 'Tidak ada nama usaha' }}</td>
                            <td>
                                @if (method_exists($user, 'isProfileCompleted') && $user->isProfileCompleted())
                                    <span class="badge bg-success">Lengkap</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lengkap</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->email_verified_at)
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-danger">Belum Terverifikasi</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection
