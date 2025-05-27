@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        {{-- Email Input --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Admin Email" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        {{-- Password Input --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        {{-- Error Message --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
@endsection
