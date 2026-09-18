<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#1f2937">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('third_party_stylesheets')
    @stack('page_css')

    <link href="{{ asset('css/ui-refine.css') }}?v=20260918-5" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed sm-app-shell">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link sm-topbar-button" data-widget="pushmenu" href="#" role="button"
                        aria-label="Abrir o cerrar menú">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-flex sm-topbar-context">
                    <div>
                        <div class="sm-topbar-context__title">{{ config('app.name') }}</div>
                        <div class="sm-topbar-context__subtitle">Gestión operativa</div>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sm-topbar-button" data-widget="fullscreen" href="#" role="button"
                        aria-label="Pantalla completa">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle sm-user-trigger" data-toggle="dropdown"
                        aria-expanded="false">
                        <span class="sm-user-avatar" aria-hidden="true">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        <span class="sm-user-copy text-left d-none d-sm-block">
                            <span class="sm-user-name d-block">{{ Auth::user()->name }}</span>
                            <span class="sm-user-role d-block">{{ Auth::user()->email }}</span>
                        </span>
                        <i class="fas fa-chevron-down sm-user-chevron"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right sm-user-menu">
                        <div class="sm-profile-card">
                            <span class="sm-profile-card__avatar" aria-hidden="true">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <div class="min-w-0">
                                <p class="sm-profile-card__name">{{ Auth::user()->name }}</p>
                                <p class="sm-profile-card__caption">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="sm-profile-actions">
                            <a href="{{ url('users/detail/perfil') }}" class="btn btn-default">
                                <i class="fas fa-user-cog"></i>
                                Perfil
                            </a>
                            <a href="#" class="btn btn-outline-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                Salir
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

        <main class="content-wrapper" id="main-content">
            @yield('content')
        </main>

        <footer class="main-footer">
            <span>© {{ date('Y') }} {{ config('app.name') }}</span>
            <span class="float-right d-none d-sm-inline">Sistema interno</span>
        </footer>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form.confirm-submit').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.dataset.confirmed === '1') {
                        return;
                    }

                    event.preventDefault();

                    Swal.fire({
                        title: '¿Guardar los cambios?',
                        text: 'Revise la información antes de continuar.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true,
                        confirmButtonColor: '#315f8c'
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            form.dataset.confirmed = '1';
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
                    confirmButtonColor: '#315f8c'
                });
            @endif
        });

        $(document).on('click', '.alert-delete, .alert-confirm', function (event) {
            event.preventDefault();

            const trigger = $(this);
            const form = trigger.closest('form');
            const isDelete = trigger.hasClass('alert-delete');
            const valor = trigger.data('mensaje') || 'este registro';
            const accion = trigger.data('accion') || (isDelete ? 'eliminar' : 'confirmar');

            Swal.fire({
                title: isDelete ? 'Confirmar eliminación' : 'Confirmar acción',
                text: `¿Desea ${accion} ${valor}?`,
                icon: isDelete ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                confirmButtonColor: isDelete ? '#dc2626' : '#315f8c'
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.trigger('submit');
                }
            });
        });

        $(function () {
            $('.select2:visible').each(function () {
                const select = $(this);

                if (!select.hasClass('select2-hidden-accessible')) {
                    select.select2({
                        placeholder: select.data('placeholder') || 'Seleccione...',
                        width: '100%',
                        allowClear: true
                    });
                }
            });

            const timers = new WeakMap();
            const requests = new WeakMap();

            document.querySelectorAll('.js-remote-search, .buscar, .buscar-fotos').forEach(function (input) {
                input.addEventListener('input', function () {
                    const field = this;
                    const url = field.dataset.url;
                    const param = field.dataset.param || field.name || 'buscar';
                    const targetSelector = field.dataset.target ||
                        (field.classList.contains('buscar-fotos') ? '.tabla-fotos-container' : '.tabla-container');

                    if (!url || !targetSelector) {
                        return;
                    }

                    window.clearTimeout(timers.get(field));

                    timers.set(field, window.setTimeout(function () {
                        const previousRequest = requests.get(field);
                        if (previousRequest) {
                            previousRequest.abort();
                        }

                        const controller = new AbortController();
                        requests.set(field, controller);

                        const separator = url.includes('?') ? '&' : '?';

                        fetch(url + separator + encodeURIComponent(param) + '=' + encodeURIComponent(field.value), {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' },
                            signal: controller.signal
                        })
                            .then(function (response) {
                                if (!response.ok) {
                                    throw new Error('No se pudo actualizar la búsqueda.');
                                }

                                return response.text();
                            })
                            .then(function (html) {
                                const target = document.querySelector(targetSelector);
                                if (target) {
                                    target.innerHTML = html;
                                }
                            })
                            .catch(function (error) {
                                if (error.name !== 'AbortError') {
                                    console.error(error);
                                }
                            });
                    }, 250));
                });
            });
        });
    </script>

    @stack('third_party_scripts')
    @stack('page_scripts')
    @include('sweetalert::alert')
</body>
</html>
