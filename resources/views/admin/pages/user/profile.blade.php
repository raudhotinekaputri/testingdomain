@extends('adminlte::page')

@section('title', 'Lengkapi Profil User')

@section('content_header')
    <h1>Lengkapi Profil User</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.profile.store', $user->id) }}" method="POST">
            @csrf        
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="form-group">
                <label>No. WhatsApp</label>
                <input type="text" name="no_whatsapp" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Nama Usaha</label>
                <input type="text" name="nama_usaha" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat Usaha</label>
                <textarea name="alamat_usaha" class="form-control" required></textarea>
            </div>
            <select name="kategori_usaha" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_usaha', $user->profile->kategori_usaha ?? '') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>            
            <button type="submit" class="btn btn-success">Simpan Profil</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Lewati</a>
        </form>
        @error('nama')
    <small class="text-danger">{{ $message }}</small>
@enderror
    </div>
</div>
@endsection
