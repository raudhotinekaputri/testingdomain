@extends('adminlte::auth.passwords.reset')

@section('auth_body')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', request()->email) }}" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password Baru" required>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
</form>
@endsection

@section('auth_footer')
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection
