@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kirim Saran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('saran.store') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Anda</label>
            <input type="email" name="email" class="form-control" required placeholder="nama@email.com">
        </div>

        <div class="form-group">
            <label for="isi">Isi Saran</label>
            <textarea name="isi" class="form-control" rows="5" required placeholder="Tulis sarannya di sini..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
    </form>
</div>
@endsection

