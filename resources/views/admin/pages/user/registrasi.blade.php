@extends('adminlte::page')

@section('title', 'Approval User')

@section('content_header')
    <h1>Approval User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Pending Approval</h3>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Verifikasi Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name ?? '-' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->email_verified_at)
                            <span class="badge badge-success">✅ Sudah Verifikasi</span>
                        @else
                            <form action="{{ route('admin.users.verifyEmail', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Verifikasi email user ini?')">
                                    Belum Verifikasi Email
                                </button>                                                             
                            </form>
                        @endif
                    </td>                    
                    <td>
                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui user ini?')">
                                ✅ Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak user ini?')">
                                ❌ Reject
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada user yang menunggu persetujuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@stop
