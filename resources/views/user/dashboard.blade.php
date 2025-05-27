@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

<div class="container px-4 px-md-5 py-3">
    <h1 class="mb-4">Dashboard</h1>

    @if($profileIncomplete)
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <div>
            <strong>Lengkapi Profil Usaha Anda!</strong><br>
            Untuk menggunakan semua fitur dengan maksimal, mohon lengkapi data profil usaha Anda.
        </div>
        <a href="{{ route('user.profile.edit') }}" class="btn btn-sm btn-warning">
            Lengkapi Sekarang
        </a>
    </div>
    @endif

    <!-- Profil User -->
    <a href="{{ route('user.profile.show') }}" class="text-decoration-none text-dark">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </a>

    <div class="row gx-4 gy-4">
        <!-- Pelatihan -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pelatihan</h5>
                    <a href="{{ route('user.pelatihan.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($pelatihans as $pelatihan)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('user.pelatihan.show', $pelatihan->id) }}" class="text-decoration-none text-dark">
                                        <strong>{{ $pelatihan->judul }}</strong> <br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }} -
                                            {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}
                                        </small>
                                    </a>
                                </div>
                                <span class="badge 
                                    @if($pelatihan->status == 'Sedang Berlangsung') bg-primary
                                    @elseif($pelatihan->status == 'Belum Dimulai') bg-warning text-dark
                                    @else bg-danger
                                    @endif">
                                    {{ $pelatihan->status }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada pelatihan.</li>
                        @endforelse
                    </ul>                 
                </div>
            </div>
        </div>

        <!-- Produk User -->
<div class="col-md-6">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Produk Anda</h5>
            @if($profileIncomplete)
                <button class="btn btn-sm btn-light" id="btnTambahProduk">Tambah Produk</button>
            @else
                <a href="{{ route('user.produks.index') }}" class="btn btn-sm btn-light">Tambah Produk</a>
            @endif
        </div>
        <div class="card-body">
            <ul class="list-group">
                @forelse ($produks as $produk)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $produk->judul }}</strong> <br>
                            <small class="text-muted">{{ Str::limit($produk->deskripsi, 50) }}</small>
                        </div>
                        <div>
                            <a href="{{ route('user.produks.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('user.produks.destroy', $produk->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Belum ada produk.</li>
                @endforelse
            </ul>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $produks->links() }} 
            </div>
        </div>
    </div>
</div>


        <!-- Acara User -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Acara Anda</h5>
                    <a href="{{ route('user.acara.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($acaras as $acara)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('user.acara.show', $acara->id) }}" class="text-decoration-none text-dark">
                                        <strong>{{ $acara->judul }}</strong> <br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($acara->tanggal)->translatedFormat('d F Y') }}
                                        </small>
                                    </a>
                                </div>
                                <span class="badge 
                                    @if($acara->status == 'Sedang Berlangsung') bg-primary
                                    @elseif($acara->status == 'Belum Dimulai') bg-warning text-dark
                                    @else bg-danger
                                    @endif">
                                    {{ $acara->status }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada acara.</li>
                        @endforelse
                    </ul>           
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    @if($profileIncomplete)
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btnTambahProduk').addEventListener('click', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Profil Belum Lengkap!',
                text: 'Silakan lengkapi profil usaha terlebih dahulu sebelum menambahkan produk.',
                confirmButtonText: 'Lengkapi Sekarang'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user.profile.edit') }}";
                }
            });
        });
    </script>
    @endif
@endpush
