@extends('adminlte::page')

@section('title', 'Tambah Sub Informasi')

@section('content_header')
    <h1>Tambah Sub Informasi</h1>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('admin.sub_informasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (Opsional)</label>
                <input type="file" class="form-control" id="gambar" name="gambar">
            </div>

            <div class="mb-3">
                <label for="video" class="form-label">Video (Opsional)</label>
                <input type="file" class="form-control" id="video" name="video">
            </div>

            <div class="mb-3">
                <label for="dokumen" class="form-label">Dokumen (Opsional)</label>
                <input type="file" class="form-control" id="dokumen" name="dokumen">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.sub_informasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#deskripsi', 
        plugins: 'lists link image',  
        toolbar: 'bold italic underline | bullist numlist | link image', 
        menubar: false,  
        statusbar: false,  
        height: 300,  // Mengatur tinggi editor
        forced_root_block: false,  // Memastikan <br> tidak diubah jadi <p>
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();  // Menyimpan perubahan di textarea saat editor berubah
            });
        }
    });
</script>
