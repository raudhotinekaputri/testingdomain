@extends('adminlte::page')

@section('title', 'Edit Sub Informasi')

@section('content_header')
    <h1>Edit Sub Informasi</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.sub_informasi.update', $subInformasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $subInformasi->judul) }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $subInformasi->deskripsi) }}</textarea>
            </div>

            {{-- Gambar Lama --}}
            <div class="mb-3">
                <label class="form-label">Gambar Lama</label>
                <div>
                    @if ($subInformasi->gambar)
                        <img src="{{ asset('storage/'.$subInformasi->gambar) }}" class="img-thumbnail" style="width: 200px; height: auto;">
                        <button type="submit" name="hapus_gambar" value="hapus" class="btn btn-danger mt-2">Hapus Gambar</button>
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </div>
            </div>

            {{-- Upload Gambar Baru --}}
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar Baru</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            </div>

            {{-- Dokumen Lama --}}
            <div class="mb-3">
                <label class="form-label">Dokumen Lama</label>
                <div>
                    @if ($subInformasi->dokumen)
                        <a href="{{ asset('storage/'.$subInformasi->dokumen) }}" class="btn btn-info" target="_blank">Lihat Dokumen</a>
                        <button type="submit" name="hapus_dokumen" value="hapus" class="btn btn-danger mt-2">Hapus Dokumen</button>
                    @else
                        <span class="text-muted">Tidak ada dokumen</span>
                    @endif
                </div>
            </div>

            {{-- Upload Dokumen Baru --}}
            <div class="mb-3">
                <label for="dokumen" class="form-label">Upload Dokumen Baru</label>
                <input type="file" name="dokumen" id="dokumen" class="form-control" accept=".pdf,.docx,.txt">
            </div>

            {{-- Video Lama --}}
            <div class="mb-3">
                <label class="form-label">Video Lama</label>
                <div>
                    @if ($subInformasi->video)
                        <video width="320" height="240" controls>
                            <source src="{{ asset('storage/'.$subInformasi->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <button type="submit" name="hapus_video" value="hapus" class="btn btn-danger mt-2">Hapus Video</button>
                    @else
                        <span class="text-muted">Tidak ada video</span>
                    @endif
                </div>
            </div>

            {{-- Upload Video Baru --}}
            <div class="mb-3">
                <label for="video" class="form-label">Upload Video Baru</label>
                <input type="file" name="video" id="video" class="form-control" accept="video/mp4,video/avi">
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.sub_informasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@stop

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#deskripsi',  // Pastikan selector sesuai dengan elemen textarea kamu
        plugins: 'lists',  // Plugin untuk membuat list (unordered, ordered)
        toolbar: 'bold italic underline | bullist numlist',  // Tombol untuk Bold, Italic, dan List
        menubar: false,  // Menyembunyikan menu bar atas jika tidak diperlukan
        statusbar: false,  // Menyembunyikan status bar jika tidak diperlukan
        height: 300,  // Atur tinggi editor sesuai kebutuhan
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();  // Menyimpan perubahan di textarea saat editor berubah
            });
        }
    });
</script>
