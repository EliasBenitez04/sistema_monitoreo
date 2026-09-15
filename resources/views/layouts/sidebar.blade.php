<aside class="main-sidebar sidebar-dark-primary elevation-0">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('storage/logos/gts_logo.jpg') }}" alt="{{ config('app.name') }}" class="brand-image sm-brand-logo">
        <span class="sm-brand-copy">
            <span class="sm-brand-name">{{ config('app.name') }}</span>
            <span class="sm-brand-caption">Gestión operativa</span>
        </span>
    </a>

    <div class="sidebar">
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
