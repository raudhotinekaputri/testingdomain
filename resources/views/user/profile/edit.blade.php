@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center my-4">
    <div class="w-100" style="max-width: 900px; padding: 0 16px;">
        <div class="bg-white p-4 p-md-5 shadow rounded">
            <h2 class="mb-4">Edit Profil</h2>
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                  {{-- User ID --}}
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                </div>
            
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Foto Profil</label>
                    <input type="file" name="profile_picture" class="form-control" accept="image/*">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                             class="mt-2 rounded-circle" width="100" height="100" alt="Profile Picture">
                    @endif
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nama <span style="color: red;">*</span></label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $profile->nama ?? '') }}" required>
                </div>
            
                <div class="mb-3">
                    <label class="form-label">No WhatsApp</label>
                    <input type="text" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp', $profile->no_whatsapp ?? '') }}">
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Nama Usaha <span style="color: red;">*</span></label>
                    @if ($profile)
                    <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $profile->nama_usaha ?? '') }}">
                    @endif
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Alamat Usaha <span style="color: red;">*</span></label>
                    <input type="text" name="alamat_usaha" class="form-control" value="{{ old('alamat_usaha', $profile->alamat_usaha ?? '') }}">
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Kategori Usaha</label>
                    <select name="kategori_usaha" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori_usaha_list as $kategori)
                            <option value="{{ $kategori->id }}" 
                                {{ old('kategori_usaha', $profile->kategori_usaha ?? '') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>            
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nomor Izin Usaha</label>
                    <input type="text" name="nomor_izin_usaha" class="form-control" value="{{ old('nomor_izin_usaha', $profile->nomor_izin_usaha) }}">
                </div>
            
                <div class="mb-3">
                    <label class="form-label">No WhatsApp Usaha <span style="color: red;">*</span></label>
                    <input type="text" name="nomor_whatsapp_usaha" class="form-control" value="{{ old('nomor_whatsapp_usaha', $profile->nomor_whatsapp_usaha) }}" required>
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Link Olshop 1</label>
                    <input type="url" name="link_olshop_1" class="form-control" value="{{ old('link_olshop_1', $profile->link_olshop_1) }}">
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Link Olshop 2</label>
                    <input type="url" name="link_olshop_2" class="form-control" value="{{ old('link_olshop_2', $profile->link_olshop_2) }}">
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Deskripsi Usaha <span style="color: red;">*</span></label>
                    <textarea name="deskripsi_usaha" class="form-control">{{ old('deskripsi_usaha', $profile->deskripsi_usaha) }}</textarea>
                </div>

                <hr>

                <h4>Ganti Password (Opsional)</h4>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">👁️</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">👁️</button>
                    </div>
                </div>
            
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('user.profile.show') }}" class="btn btn-secondary">Batal</a>
            </form>    
        </div>
    </div>
</div>

<script>
    function togglePassword(id) {
        var input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
@endsection
