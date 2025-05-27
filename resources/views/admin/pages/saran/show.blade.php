@extends('adminlte::page')

@section('title', 'Detail Saran')

@section('content_header')
    <h1>Detail Saran</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Email:</strong> {{ $saran->email }}</p>
        <p><strong>Isi Saran:</strong> {{ $saran->isi }}</p>
        <p><strong>Status:</strong> 
            {{ $saran->is_read ? 'Sudah Ditangani' : 'Belum Ditangani' }}
        </p>

        <!-- Form untuk update status is_read -->
        <form action="{{ route('saran.update', $saran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_read" value="1" id="isReadCheck"
                    {{ $saran->is_read ? 'checked' : '' }}>
                <label class="form-check-label" for="isReadCheck">
                    Tandai sebagai sudah ditangani
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>

        <a href="{{ route('saran.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@stop
