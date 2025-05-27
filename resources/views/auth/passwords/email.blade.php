@extends('adminlte::auth.passwords.email')

@section('auth_body')
@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Kirim Link Reset</button>
</form>
@endsection
