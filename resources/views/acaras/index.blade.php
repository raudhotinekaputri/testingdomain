@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Sortir di atas (khusus mobile) -->
    <div class="d-block d-md-none mb-4">
        <div class="card">
            <div class="card-header">
                <strong>Sortir Acara</strong>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('acaras.index') }}">
                    <div class="mb-3">
                        <label for="kategori_mobile" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori_mobile" class="form-select">
                            <option value="">Semua</option>
                            @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>                            
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bulan_mobile" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan_mobile" class="form-select">
                            <option value="">Semua</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->locale('id')->isoFormat('MMMM') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Terapkan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Acara -->
        <div class="col-md-8">
            <h1 class="mb-4">Acara</h1>

            <!-- Acara Terbaru -->
            @if ($acarasTerbaru)
                <div class="card mb-4">
                    @if ($acarasTerbaru->foto)
                        <img src="{{ asset('storage/'.$acarasTerbaru->foto) }}" 
                             class="card-img-top img-fluid"
                             style="max-width: 400px; height: auto; object-fit: contain; display: block; margin: 15px auto;"
                             alt="{{ $acarasTerbaru->judul }}">
                    @endif
                    <div class="card-body">
                        <h2>{{ $acarasTerbaru->judul }}</h2>
                        <p>{{ Str::limit($acarasTerbaru->deskripsi, 150, '...') }}</p>
                        <a href="{{ route('acaras.show', $acarasTerbaru->id) }}" class="btn btn-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            @else
                <p class="text-muted">Belum ada acara terbaru.</p>
            @endif

            <!-- Acara Sebelumnya -->
            @if ($acarasLainnya->isNotEmpty())
                <h3>Acara Lainnya</h3>
                <div class="row">
                    @foreach ($acarasLainnya as $acara)
                        <div class="col-md-6 col-sm-12">
                            <div class="card mb-4">
                                @if ($acara->foto)
                                    <img src="{{ asset('storage/'.$acara->foto) }}" 
                                         class="card-img-top img-fluid"
                                         style="max-width: 250px; height: auto; object-fit: contain; display: block; margin: 10px auto;"
                                         alt="{{ $acara->judul }}">
                                @endif
                                <div class="card-body">
                                    <h5>{{ $acara->judul }}</h5>
                                    <p>{{ Str::limit($acara->deskripsi, 100, '...') }}</p>
                                    <p class="text-muted small">
                                        {{ $acara->tanggal_mulai->format('d M Y') }} - {{ $acara->tanggal_selesai->format('d M Y') }}
                                    </p>
                                    
                                    <a href="{{ route('acaras.show', $acara->id) }}" class="btn btn-secondary btn-sm">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Belum ada acara lainnya.</p>
            @endif
        </div>

        <!-- Kolom Sortir (hanya tampil di desktop/tablet) -->
        <div class="col-md-4 d-none d-md-block">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Sortir Acara</strong>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('acaras.index') }}">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select">
                                <option value="">Semua</option>
                                @foreach ($kategoriList as $kategori)
                                    <option value="{{ $kategori->nama }}" {{ request('kategori') == $kategori->nama ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan" class="form-select">
                                <option value="">Semua</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->locale('id')->isoFormat('MMMM') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Terapkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
