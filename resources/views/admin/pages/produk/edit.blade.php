@extends('adminlte::page')

@section('title', 'Edit Produk')

@section('content_header')
    <h1>Edit Produk</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.produks.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="user_id" class="form-label">User (Opsional)</label>
                    <select class="form-control" id="user_id" name="user_id">
                        <option value="">Tanpa User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $produk->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                </div>                                              

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Produk</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $produk->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $produk->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="{{ $produk->nama_pemilik }}">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $produk->alamat }}">
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $produk->whatsapp }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Olshop</label>
                    <input type="text" name="link_olshop" class="form-control" value="{{ old('link_olshop', $produk->link_olshop ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Link Sosmed</label>
                    <input type="text" name="link_sosmed" class="form-control" value="{{ old('link_sosmed', $produk->link_sosmed ?? '') }}">
                </div>                

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori_id" name="kategori_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" 
                                {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>                              

                <!-- Daftar Foto Saat Ini -->
                <div class="form-group">
                    <label for="photos">Foto Produk</label>
                    @foreach($produk->fotos as $foto)
                        <div class="photo-item">
                            <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Produk" width="100">
                            <input type="checkbox" name="delete_photos[]" value="{{ $foto->id }}"> Hapus
                        </div>
                    @endforeach
                </div>
                
                
                <!-- Thumbnail -->

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    
                    @if ($produk->thumbnail)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $produk->thumbnail) }}" class="img-thumbnail" width="150" alt="Thumbnail Produk">
                            <button type="button" class="btn btn-danger btn-sm" id="remove-thumbnail">Hapus Thumbnail</button>
                        </div>
                    @endif
                </div>

                <!-- Upload Foto Baru -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto Baru (Maks 5)</label>
                    <input type="file" name="foto[]" class="form-control" multiple accept="image/*">
                </div>

               <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.produks.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let hapusFotoArray = [];

            // Delete Photo Button Click Event
            document.querySelectorAll(".btn-danger").forEach(button => {
                button.addEventListener("click", function () {
                    let fotoId = this.getAttribute("data-id");
                    hapusFotoArray.push(fotoId);
                    document.getElementById("hapus_foto").value = JSON.stringify(hapusFotoArray);
                    this.closest(".mb-3").remove(); // Removes the whole photo and delete button block
                });
            });

            // Remove Thumbnail Button Click Event
            document.getElementById("remove-thumbnail")?.addEventListener("click", function () {
                if (confirm('Apakah Anda yakin ingin menghapus thumbnail?')) {
                    let input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "remove_thumbnail");
                    document.querySelector("form").appendChild(input);
                    this.closest("div").remove();
                }
            });
        });
    </script>
@endsection
