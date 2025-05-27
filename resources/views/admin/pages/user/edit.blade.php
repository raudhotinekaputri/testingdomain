@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@endsection

@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- User ID --}}
            <div class="form-group">
                <label>User ID</label>
                <input type="text" name="user_id" class="form-control" value="{{ $user->id }}" readonly>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {{-- Foto Profil --}}
                    <div class="form-group">
                        <label>Foto Profil</label><br>
                        @if(optional($user->profile)->foto)
                            <img src="{{ asset('storage/' . $user->profile->foto) }}"
                                 style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;"
                                 class="mb-2 shadow-sm"
                                 alt="Foto Profil">
                        @endif
                        <input type="file" name="foto" class="form-control-file">
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                 
                    {{-- Password Baru --}}
<div class="form-group">
    <label>Password (Kosongkan jika tidak ingin mengubah)</label>
    <div class="input-group">
        <input type="text" name="password" class="form-control" placeholder="Masukkan password baru">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(this)">
                <i class="fas fa-eye-slash"></i>
            </button>
        </div>
    </div>
</div>

                    {{-- Nama --}}
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $user->profile->nama ?? '' }}">
                    </div>

                    {{-- No WhatsApp --}}
                    <div class="form-group">
                        <label>No. WhatsApp</label>
                        <input type="text" name="no_whatsapp" class="form-control" value="{{ $user->profile->no_whatsapp ?? '' }}">
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control">{{ $user->profile->alamat ?? '' }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    {{-- Nama Usaha --}}
                    <div class="form-group">
                        <label>Nama Usaha</label>
                        <input type="text" name="nama_usaha" class="form-control" value="{{ $user->profile->nama_usaha ?? '' }}">
                    </div>

                    {{-- Alamat Usaha --}}
                    <div class="form-group">
                        <label>Alamat Usaha</label>
                        <textarea name="alamat_usaha" class="form-control">{{ $user->profile->alamat_usaha ?? '' }}</textarea>
                    </div>

                    {{-- Kategori Usaha --}}
                    <div class="form-group">
                        <label>Kategori Usaha</label>
                        <select name="kategori_usaha" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori_usaha_list as $id => $nama)
                                <option value="{{ $id }}" {{ old('kategori_usaha', $user->profile->kategori_usaha ?? '') == $id ? 'selected' : '' }}>
                                    {{ $nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nomor Izin Usaha --}}
                    <div class="form-group">
                        <label>Nomor Izin Usaha</label>
                        <input type="text" name="nomor_izin_usaha" class="form-control" value="{{ $user->profile->nomor_izin_usaha ?? '' }}">
                    </div>

                    {{-- Nomor WhatsApp Usaha --}}
                    <div class="form-group">
                        <label>Nomor WhatsApp Usaha</label>
                        <input type="text" name="nomor_whatsapp_usaha" class="form-control" value="{{ $user->profile->nomor_whatsapp_usaha ?? '' }}">
                    </div>

                    {{-- Deskripsi Usaha --}}
                    <div class="form-group">
                        <label>Deskripsi Usaha</label>
                        <textarea name="deskripsi_usaha" class="form-control">{{ $user->profile->deskripsi_usaha ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
    function togglePassword(button) {
        const input = button.closest('.input-group').querySelector('input');
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>

@endsection
