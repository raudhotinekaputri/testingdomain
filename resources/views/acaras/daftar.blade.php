@extends('layouts.app')

@section('title', 'Pendaftaran Acara')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header fw-bold">Pendaftaran Acara</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('acaras.peserta.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="acara_id" value="{{ $acara->id }}">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
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
