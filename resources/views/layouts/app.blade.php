<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @php
    use Illuminate\Support\Facades\Route;
@endphp    

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'UMKM Patikraja') }}</title>
    
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- FontAwesome (Ikon) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
        <!-- Google Font Poppins -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

        <!-- Tambahin CSS custom -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <style>
            /* Memastikan dropdown tidak keluar dari layar */
            .nav-item.dropdown .dropdown-menu {
                left: 0 !important;  /* Menjaga dropdown tetap dalam layar */
                right: auto !important;
                top: 100% !important;  /* Pastikan dropdown muncul di bawah tombol */
                z-index: 1050;  /* Agar dropdown tidak tertutup oleh elemen lain */
            }
        </style>
    </head>
    
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pelatihans.index') }}">Pelatihan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/acaras') }}">Acara</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/profil-organisasi') }}">Profil Organisasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/informasi') }}">Informasi</a></li>
                    </ul>                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/login/user') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{ route('user.logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        @stack('scripts') {{-- biar bisa dipakai dari view --}}
        
        {{-- Cek apakah pengguna tidak di halaman admin atau halaman yang tidak perlu footer --}}
        @if (!request()->is('user/*') && !request()->is('admin/*'))
            @php
            $footer = \App\Models\Footer::first();
            @endphp
        
            @include('partials.footer', ['footer' => $footer])
        @endif
        
    </body>
</html>

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Perhatian!</strong> {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
