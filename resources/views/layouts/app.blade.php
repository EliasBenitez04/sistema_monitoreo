<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#0f172a">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('third_party_stylesheets')
    @stack('page_css')

    {{-- Final visual refinement layer: intentionally loaded last to normalize legacy screens. --}}
    <link href="{{ asset('css/ui-refine.css') }}?v=20260918" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed sm-app-shell">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Abrir o cerrar menú">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>

                <li class="nav-item sm-topbar-context">
                    <div>
                        <div class="sm-topbar-context__title">Centro de operaciones</div>
                        <div class="sm-topbar-context__subtitle">{{ config('app.name') }}</div>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button" aria-label="Pantalla completa">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle sm-user-trigger" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/logos/gts_logo.jpg') }}" class="sm-user-avatar" alt="Logo">
                        <span class="sm-user-copy text-left d-none d-sm-block">
                            <span class="sm-user-name d-block">{{ Auth::user()->name }}</span>
                            <span class="sm-user-role d-block">Usuario del sistema</span>
                        </span>
                        <i class="fas fa-chevron-down ml-1" style="font-size: 9px;"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="sm-profile-card">
                            <img src="{{ asset('storage/logos/gts_logo.jpg') }}" class="sm-profile-card__avatar" alt="Logo">
                            <div class="min-w-0">
                                <p class="sm-profile-card__name">{{ Auth::user()->name }}</p>
                                <p class="sm-profile-card__caption">Sesión activa · Acceso seguro</p>
                            </div>
                        </div>

                        <div class="sm-profile-actions">
                            <a href="{!! url('users/detail/perfil') !!}" class="btn btn-default">
                                <i class="fas fa-user-cog mr-1"></i> Perfil
                            </a>
                            <a href="#" class="btn btn-outline-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-1"></i> Salir
                            </a>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        @include('layouts.sidebar')

        <main class="content-wrapper">
            @yield('content')
        </main>

        <footer class="main-footer">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
                <span>© {{ date('Y') }} {{ config('app.name') }} · Plataforma operativa interna</span>
                <span class="mt-1 mt-sm-0">Operación segura y trazable</span>
            </div>
        </footer>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form.confirm-submit').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Guardar los cambios?',
                        text: 'Verifique la información antes de continuar.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, guardar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true,
                        confirmButtonColor: '#2563eb'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            @if (Session::has('swal-alert'))
                const alertData = @json(Session::get('swal-alert'));
                Swal.fire({
                    icon: alertData.icon,
                    title: alertData.title,
                    text: alertData.text,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#2563eb'
                });
            @endif
        });
    </script>

    <script>
        $(document).on('click', '.alert-delete', function(event) {
            event.preventDefault();

            const form = $(this).closest('form');
            const valor = $(this).data('mensaje') || 'este registro';
            const accion = $(this).data('accion') || 'eliminar';

            Swal.fire({
                title: 'Confirmar acción',
                text: `¿Desea ${accion} ${valor}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                confirmButtonColor: '#dc2626'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $(document).on('click', '.alert-confirm', function(event) {
            event.preventDefault();

            const form = $(this).closest('form');
            const valor = $(this).data('mensaje') || 'este registro';
            const accion = $(this).data('accion') || 'confirmar';

            Swal.fire({
                title: 'Confirmar acción',
                text: `¿Desea ${accion} ${valor}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                confirmButtonColor: '#2563eb'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.buscar').on('keyup', function() {
                const query = this.value;
                const url = this.getAttribute('data-url');

                if (!url) return;

                fetch(url + '?buscar=' + encodeURIComponent(query), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(res => res.text())
                    .then(html => $('.tabla-container').html(html))
                    .catch(err => console.error(err));
            });

            $('#form-busqueda-fotos .buscar-fotos').on('keyup', function() {
                const query = this.value;
                const url = this.getAttribute('data-url');

                if (!url) return;

                fetch(url + '?search=' + encodeURIComponent(query), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(res => res.text())
                    .then(html => $('.tabla-fotos-container').html(html))
                    .catch(err => console.error(err));
            });

            $('.select2:visible').select2({
                placeholder: 'Seleccione...',
                width: '100%',
                allowClear: true
            });
        });
    </script>

    @stack('third_party_scripts')
    @stack('page_scripts')
    @include('sweetalert::alert')
</body>

</html>
