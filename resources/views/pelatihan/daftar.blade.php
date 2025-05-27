@extends('layouts.app')

@section('title', 'Daftar Pelatihan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Pelatihan: {{ $pelatihan->judul }}</div>
                <div class="card-body">
                    <form action="{{ route('pelatihan_peserta.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pelatihan_id" value="{{ $pelatihan->id }}">

                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="whatsapp">WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_usaha">Nama Usaha (Opsional)</label>
                            <input type="text" name="nama_usaha" class="form-control">
                        </div>                        

                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
