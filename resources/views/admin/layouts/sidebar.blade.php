<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li><a href="{{ route('admin.acaras.index') }}"><i class="fa fa-calendar"></i> <span>Kelola Acara</span></a></li>
                <li><a href="{{ route('admin.umkms.index') }}"><i class="fa fa-building"></i> <span>Kelola UMKM</span></a></li>
            </ul>
        </nav>
    </div>
</aside>
