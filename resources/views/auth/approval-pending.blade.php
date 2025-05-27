@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="container text-center">
    <h3>Akun Anda sedang menunggu persetujuan admin</h3>
    <p>Silakan tunggu hingga admin menyetujui akun Anda.</p>
    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Kembali ke Login</a>
</div>
@endsection
