@extends('adminlte::page')

@section('title', 'Kelola Sertifikat')

@section('content_header')
    <h1>Kelola Sertifikat Peserta</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Informasi Peserta</h5>

        <p>
            <strong>Status Sertifikat:</strong>
            @if ($peserta->file_sertifikat)
                <span class="badge badge-success">Sudah Upload</span>
            @else
                <span class="badge badge-warning">Belum Upload</span>
            @endif
        </p>

        <div class="row">
            <div class="col-md-6 mb-2">
                <strong>Nama:</strong><br>{{ $peserta->nama }}
            </div>
            <div class="col-md-6 mb-2">
                <strong>Nama Usaha:</strong><br>{{ $peserta->nama_usaha ?? '-' }}
            </div>
            <div class="col-md-6 mb-2">
                <strong>Pelatihan:</strong><br>{{ $peserta->pelatihan->judul ?? '-' }}
            </div>
            <div class="col-md-6 mb-2">
                @php
    use Illuminate\Support\Carbon;

    $tanggalMulai = $peserta->pelatihan->tanggal_mulai ?? null;
    $tanggalSelesai = $peserta->pelatihan->tanggal_selesai ?? null;
@endphp

<p>
    <strong>Tanggal Pelatihan:</strong>
    @if ($tanggalMulai && $tanggalSelesai)
        {{ Carbon::parse($tanggalMulai)->translatedFormat('d F Y') }}
        s.d.
        {{ Carbon::parse($tanggalSelesai)->translatedFormat('d F Y') }}
    @else
        -
    @endif
</p>

            </div>
            <div class="col-md-6 mb-2">
                <strong>WhatsApp:</strong><br>
                <a href="https://wa.me/{{ $peserta->whatsapp }}" target="_blank">{{ $peserta->whatsapp }}</a>
            </div>
            <div class="col-md-6 mb-2">
                <strong>Email:</strong><br>{{ $peserta->email }}
            </div>
            <div class="col-12 mb-2">
                <strong>Alamat:</strong><br>{{ $peserta->alamat }}
            </div>
        </div>
    </div>
</div>

@if ($peserta->file_sertifikat)
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Sertifikat saat ini:</strong></p>
            <div class="d-flex flex-wrap align-items-center gap-2">
                <a href="{{ asset('storage/' . $peserta->file_sertifikat) }}" target="_blank" class="btn btn-info me-3 mt-3">Lihat Sertifikat</a>

                <form action="{{ route('admin.peserta_pelatihan.sertifikat.delete', $peserta->id) }}" method="POST" onsubmit="return confirm('Yakin hapus sertifikat?')" class="mt-3 me-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Sertifikat</button>
                </form>

                <a href="{{ route('admin.peserta_pelatihan.generate_sertifikat', $peserta->id) }}" class="btn btn-secondary ms-auto mt-3" target="_blank">
                    Contoh Sertifikat
                </a>
            </div>
        </div>
    </div>
@endif

<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('admin.peserta_pelatihan.sertifikat.upload', $peserta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="file_sertifikat">Upload Sertifikat (PDF/JPG/PNG)</label>
                <input type="file" name="file_sertifikat" class="form-control">
                @error('file_sertifikat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan / Ganti Sertifikat</button>
                <a href="{{ route('admin.peserta_pelatihan.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </form>
    </div>
</div>
@stop
