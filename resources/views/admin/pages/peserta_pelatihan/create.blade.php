<!-- resources/views/admin/pages/peserta_pelatihan/create.blade.php -->
@extends('adminlte::page')

@section('title', 'Tambah Peserta Pelatihan')

@section('content_header')
    <h1>Tambah Peserta Pelatihan</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulir Peserta Pelatihan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.peserta_pelatihan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">User - Opsional</label>
                    <select class="form-control" id="user_id" name="user_id">
                        <option value="">-- Pilih User (jika ada) --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>                
                
                <div class="form-group">
                    <label for="nama">Nama Peserta</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Peserta</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="nama_usaha">Nama Usaha</label>
                    <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" placeholder="Masukkan Nama Usaha">
                </div>        
                
                <div class="form-group">
                    <label for="whatsapp">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="Masukkan nomor WhatsApp" required>
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>                

                <div class="form-group">
                    <label for="pelatihan_id">Pelatihan</label>
                    <select class="form-control" id="pelatihan_id" name="pelatihan_id" required>
                        @foreach($pelatihans as $pelatihan)
                            <option value="{{ $pelatihan->id }}">{{ $pelatihan->judul }}</option>
                        @endforeach
                    </select>
                </div>
<div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.peserta_pelatihan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            </form>
        </div>
    </div>
@endsection
