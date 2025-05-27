@extends('adminlte::page')

@section('title', 'Edit Pelatihan')

@section('content_header')
    <h1>Edit Pelatihan</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pelatihans.update', $pelatihan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $pelatihan->judul }}" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required>{{ $pelatihan->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                    @if($pelatihan->foto)
                        <img src="{{ asset('storage/' . $pelatihan->foto) }}" width="150" class="mt-2">
                        <!-- Button untuk menghapus foto -->
                        <button type="submit" name="hapus_foto" value="1" class="btn btn-danger mt-2">
                            Hapus Foto
                        </button>
                    @endif
                </div>

                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $pelatihan->tanggal_mulai }}" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ $pelatihan->tanggal_selesai }}" required>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($kategoriPelatihan as $kategori)
                            <option value="{{ $kategori->id }}" {{ $pelatihan->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>                                         
                </div>
                
                <div class="form-group">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control" value="{{ $pelatihan->jam }}" required>
                </div>

                <div class="form-group">
                    <label>Tipe</label>
                    <select name="tipe" class="form-control">
                        <option value="offline" {{ $pelatihan->tipe == 'offline' ? 'selected' : '' }}>Offline</option>
                        <option value="hybrid" {{ $pelatihan->tipe == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Lokasi (Jika Offline)</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ $pelatihan->lokasi }}">
                </div>

                <div class="form-group">
                    <label>Penyelenggara</label>
                    <input type="text" name="penyelenggara" class="form-control" value="{{ $pelatihan->penyelenggara }}" required>
                </div>

                <div class="form-group">
                    <label>Khusus UMKM Patikraja</label>
                    <select name="khusus_umkm_patikraja" class="form-control">
                        <option value="1" {{ $pelatihan->khusus_umkm_patikraja ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ !$pelatihan->khusus_umkm_patikraja ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.pelatihans.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    @if(session('foto_hapus'))
        <div class="alert alert-success mt-3">
            {{ session('foto_hapus') }}
        </div>
    @endif
@endsection
