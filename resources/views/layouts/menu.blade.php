@php
    $menuCargaDatos = request()->routeIs(
        'lineas.*',
        'Departamentos.*',
        'ciudades.*',
        'clientes.*',
        'sucursal.*',
        'articulos.*',
        'stocks.*',
    );

    $menuConfiguracion = request()->routeIs('usuarios.*', 'permissions.*', 'roles.*');
    $menuMonitoreo = request()->routeIs('stock_ventas_sucursales.*', 'RedistribucionSugeridas.*');
    $menuOt = request()->routeIs('ot.*', 'ots.*', 'dashboard.ot', 'dashboard.ot-logistica', 'dashboard.ot-atrasadas');
@endphp

<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Inicio</p>
    </a>
</li>

@can('pedido_compras index')
    <li class="nav-header">DATOS MAESTROS</li>

    <li class="nav-item {{ $menuCargaDatos ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ $menuCargaDatos ? 'active' : '' }}">
            <i class="nav-icon fas fa-database"></i>
            <p>
                Gestión de datos
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('articulos.index') }}" class="nav-link {{ request()->routeIs('articulos.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-box-open"></i>
                    <p>Artículos</p>
                </a>
            </li>

            @can('stocks importar')
                <li class="nav-item">
                    <a href="{{ route('stocks.index') }}" class="nav-link {{ request()->routeIs('stocks.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Importar stock</p>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a href="{{ route('lineas.index') }}" class="nav-link {{ request()->routeIs('lineas.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Líneas</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('sucursal.index') }}" class="nav-link {{ request()->routeIs('sucursal.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-store"></i>
                    <p>Sucursales</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>Clientes</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('Departamentos.index') }}" class="nav-link {{ request()->routeIs('Departamentos.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-map-marked-alt"></i>
                    <p>Departamentos</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('ciudades.index') }}" class="nav-link {{ request()->routeIs('ciudades.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-city"></i>
                    <p>Ciudades</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('pedido_compras index')
    <li class="nav-header">COMPRAS</li>

    <li class="nav-item {{ request()->routeIs('pedido_compras.*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->routeIs('pedido_compras.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
                Pedidos
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('pedido_compras.index') }}" class="nav-link {{ request()->routeIs('pedido_compras.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-invoice"></i>
                    <p>Gestión de pedidos</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('ot index')
    <li class="nav-header">PRODUCCIÓN Y LOGÍSTICA</li>

    <li class="nav-item {{ $menuOt ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ $menuOt ? 'active' : '' }}">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
                Seguimiento OT
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            @can('ot importar')
                <li class="nav-item">
                    <a href="{{ route('ot.index') }}" class="nav-link {{ request()->routeIs('ot.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-import"></i>
                        <p>Importar datos</p>
                    </a>
                </li>
            @endcan

            @can('ot dashboard')
                <li class="nav-item">
                    <a href="{{ route('dashboard.ot') }}" class="nav-link {{ request()->routeIs('dashboard.ot') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard OT</p>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a href="{{ route('dashboard.ot-logistica') }}" class="nav-link {{ request()->routeIs('dashboard.ot-logistica') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>Dashboard logística</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.ot-atrasadas') }}" class="nav-link {{ request()->routeIs('dashboard.ot-atrasadas') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>OT atrasadas</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('redistribucionsugerencia index')
    <li class="nav-header">MONITOREO DE STOCK</li>

    <li class="nav-item {{ $menuMonitoreo ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ $menuMonitoreo ? 'active' : '' }}">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
                Redistribución
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            @can('redistribucionsugerencia importar')
                <li class="nav-item">
                    <a href="{{ route('stock_ventas_sucursales.index') }}" class="nav-link {{ request()->routeIs('stock_ventas_sucursales.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-import"></i>
                        <p>Importar datos</p>
                    </a>
                </li>
            @endcan

            @can('redistribucionsugerencia index')
                <li class="nav-item">
                    <a href="{{ route('RedistribucionSugeridas.index') }}" class="nav-link {{ request()->routeIs('RedistribucionSugeridas.index', 'RedistribucionSugeridas.analizar') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>Sugerencias</p>
                    </a>
                </li>
            @endcan

            @can('redistribucionsugerencia lotes')
                <li class="nav-item">
                    <a href="{{ route('RedistribucionSugeridas.lotes') }}" class="nav-link {{ request()->routeIs('RedistribucionSugeridas.lotes', 'RedistribucionSugeridas.proceso*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Gestión de lotes</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

<li class="nav-header">AUDITORÍA</li>

<li class="nav-item {{ request()->routeIs('control.terminacion') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->routeIs('control.terminacion') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Terminación
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('control.terminacion') }}" class="nav-link {{ request()->routeIs('control.terminacion') ? 'active' : '' }}">
                <i class="nav-icon fas fa-check-double"></i>
                <p>Control de terminación</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-header">ADMINISTRACIÓN</li>

<li class="nav-item {{ $menuConfiguracion ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ $menuConfiguracion ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            Configuración
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Usuarios</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-key"></i>
                <p>Permisos</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>Roles</p>
            </a>
        </li>
    </ul>
</li>
