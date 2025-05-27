@extends('adminlte::auth.passwords.confirm')

@section('auth_body')
    <form action="{{ route('password.confirm') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Konfirmasi</button>
    </form>
@endsection
