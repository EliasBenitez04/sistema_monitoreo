<aside class="main-sidebar sidebar-dark-primary elevation-0">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('storage/logos/gts_logo.jpg') }}" alt="{{ config('app.name') }}" class="brand-image sm-brand-logo">
        <span class="sm-brand-copy">
            <span class="sm-brand-name">{{ config('app.name') }}</span>
            <span class="sm-brand-caption">Gestión operativa</span>
        </span>
    </a>

    <div class="sidebar">
        <div class="sm-sidebar-search">
            <div class="sm-sidebar-search__box">
                <i class="fas fa-search sm-sidebar-search__icon" aria-hidden="true"></i>
                <input
                    type="search"
                    id="sm-menu-search"
                    class="sm-sidebar-search__input"
                    placeholder="Buscar módulo..."
                    autocomplete="off"
                    aria-label="Buscar módulo en el menú">
                <span class="sm-sidebar-search__kbd">Ctrl K</span>
            </div>
            <div id="sm-menu-search-empty" class="sm-sidebar-search__empty">
                No se encontraron módulos.
            </div>
        </div>

        <nav aria-label="Navegación principal">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
