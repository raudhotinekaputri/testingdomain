@extends('adminlte::page')

@section('title', 'Edit Peserta Pelatihan')

@section('content_header')
    <h1>Edit Peserta Pelatihan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.peserta_pelatihan.update', $peserta->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="user_id">Email Peserta</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Pilih pengguna (opsional)</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $peserta->user_id ? 'selected' : '' }}>{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="pelatihan_id">Pelatihan</label>
                    <select name="pelatihan_id" id="pelatihan_id" class="form-control" required>
                        @foreach($pelatihans as $pelatihan)
                            <option value="{{ $pelatihan->id }}" {{ $pelatihan->id == $peserta->pelatihan_id ? 'selected' : '' }}>{{ $pelatihan->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $peserta->nama) }}" placeholder="Masukkan Nama Peserta">
                </div>

                <div class="form-group">
                    <label for="whatsapp">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $peserta->whatsapp) }}" placeholder="Masukkan Nomor WhatsApp">
                </div>

                <div class="form-group">
                    <label for="nama_usaha">Nama Usaha</label>
                    <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" value="{{ old('nama_usaha', $peserta->nama_usaha) }}" placeholder="Masukkan Nama Usaha">
                </div>                

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $peserta->email) }}" placeholder="Masukkan Email">
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat">{{ old('alamat', $peserta->alamat) }}</textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Peserta</button>
                    <a href="{{ route('admin.peserta_pelatihan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@stop
