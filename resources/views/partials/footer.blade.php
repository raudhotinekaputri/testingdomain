<footer class="text-light pt-5" style="background-color: #2C3E50;">
    <div class="container px-3 px-md-5">
        <div class="row">
            <!-- Tentang UMKM -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Tentang UMKM</h5>
                <hr class="mb-3" style="width: 60px; background-color: #1ABC9C; height: 2px;">
                <p>{{ $footer->tentang_umkm }}</p>
            </div>

            <!-- Kontak -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Kontak</h5>
                <hr class="mb-3" style="width: 60px; background-color: #1ABC9C; height: 2px;">
                <p><i class="fas fa-map-marker-alt me-2"></i> {{ $footer->alamat }}</p>
                <p><i class="fas fa-envelope me-2"></i> {{ $footer->email }}</p>
                <p><i class="fas fa-phone me-2"></i> {{ $footer->telepon }}</p>
            </div>

            <!-- Sosial Media -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Ikuti Kami</h5>
                <hr class="mb-3" style="width: 60px; background-color: #1ABC9C; height: 2px;">
                <div>
                    <a href="{{ $footer->facebook ?? '#' }}" class="text-light me-3" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $footer->twitter ?? '#' }}" class="text-light me-3" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $footer->instagram ?? '#' }}" class="text-light me-3" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $footer->linkedin ?? '#' }}" class="text-light me-3" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <!-- Form Saran -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Kirim Saran</h5>
                <hr class="mb-3" style="width: 60px; background-color: #1ABC9C; height: 2px;">

                @if(session('success'))
                    <div class="alert alert-success alert-sm">{{ session('success') }}</div>
                @endif

                <form action="{{ route('saran.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="Email" required>
                    </div>
                    <div class="mb-2">
                        <textarea name="isi" class="form-control form-control-sm" rows="3" placeholder="Tulis saran" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm" style="background-color: #1ABC9C; color: white;">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3 mt-4" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2025 UMKM Patikraja - All Rights Reserved
    </div>
</footer>
