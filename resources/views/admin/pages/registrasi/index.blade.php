@extends('adminlte::page')

@section('title', 'Registrasi User')

@section('content_header')
    <h1>Daftar User yang Belum Diapprove</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Pending Approval</h3>
    </div>

    <div class="card-body">
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
                @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name ?? '-' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->email_verified_at)
                            <span class="badge badge-success">✅ Sudah Verifikasi</span>
                        @else
                            <span class="badge badge-danger">❌ Belum Verifikasi</span>
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
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@stop
