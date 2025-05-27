@extends('adminlte::page')

@section('title', 'Tambah Pelatihan')

@section('content_header')
    <h1>Tambah Pelatihan</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pelatihans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($kategoriPelatihan as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>                     
                </div>                
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tipe</label>
                    <select name="tipe" class="form-control">
                        <option value="offline">Offline</option>
                        <option value="hybrid">Hybrid</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Lokasi (Jika Offline)</label>
                    <input type="text" name="lokasi" class="form-control">
                </div>
                <div class="form-group">
                    <label>Penyelenggara</label>
                    <input type="text" name="penyelenggara" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" name="khusus_umkm_patikraja" value="0">
                    <label>
                        <input type="checkbox" name="khusus_umkm_patikraja" value="1"> Khusus UMKM Patikraja
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.pelatihans.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
