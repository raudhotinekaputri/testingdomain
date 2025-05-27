@extends('adminlte::page')

@section('title', 'Detail User')

@section('content_header')
    <h1>Detail User</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr><th>Email</th><td>{{ $user->email }}</td></tr>
                    <tr><th>Nama</th><td>{{ $user->profile->nama ?? 'Tidak ada nama' }}</td></tr>
                    <tr><th>No. WhatsApp</th><td>{{ $user->profile->no_whatsapp ?? 'Tidak ada nomor WA' }}</td></tr>
                    <tr><th>Nama Usaha</th><td>{{ $user->profile->nama_usaha ?? 'Tidak ada nama usaha' }}</td></tr>
                    <tr><th>Status Profil</th>
                        <td>
                            @if ($user->isProfileCompleted())
                                <span class="badge bg-success">Profil Lengkap</span>
                            @else
                                <span class="badge bg-warning text-dark">Profil Belum Lengkap</span>
                            @endif
                        </td>
                    </tr>
                    @if($user->profile->profile_picture)
                        <tr><th>Foto Profil</th>
                            <td>
                                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Foto Profil" width="200">
                            </td>
                        </tr>
                    @endif
                    <tr><th>Alamat Usaha</th><td>{{ $user->profile->alamat_usaha ?? 'Tidak ada alamat usaha' }}</td></tr>
                    <tr><th>Deskripsi Usaha</th><td>{{ $user->profile->deskripsi_usaha ?? 'Tidak ada deskripsi usaha' }}</td></tr>
                    <tr><th>Link Olshop 1</th><td>{{ $user->profile->link_olshop_1 ?? 'Tidak ada link' }}</td></tr>
                    <tr><th>Link Olshop 2</th><td>{{ $user->profile->link_olshop_2 ?? 'Tidak ada link' }}</td></tr>
                    <tr>
                        <th>Password</th>
                        <td>
                            <div class="input-group">
                                <input type="password" id="passwordField" class="form-control" value="{{ $user->password }}" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                        <i class="fa fa-eye" id="eyeIcon"></i> <!-- Mata icon dari Font Awesome -->
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali ke Daftar User</a>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('passwordField');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
</script>
@endpush
