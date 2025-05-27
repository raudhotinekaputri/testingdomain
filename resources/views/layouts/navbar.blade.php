<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">UMKM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @foreach (config('navigation.menu') as $menu)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is($menu['url']) ? 'active' : '' }}"
                            href="{{ url($menu['url']) }}">{{ $menu['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
