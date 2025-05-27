@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    <form action="{{ route('user.login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <div class="mt-2 text-center">
            <a href="{{ route('password.request') }}">Lupa password?</a>
        </div>
    </form>

    <div class="mt-3 text-center">
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
