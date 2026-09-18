<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#18212f">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ui-refine.css') }}?v=20260918-3" rel="stylesheet">
</head>
<body class="sm-auth-page">
    <div class="sm-auth-shell">
        <main class="sm-auth-main">
            <section class="sm-auth-card" aria-labelledby="auth-title">
                <div class="sm-auth-brand-header">
                    <img src="{{ asset('storage/logos/gts_logo.jpg') }}" alt="{{ config('app.name') }}">
                    <div>
                        <strong>{{ config('app.name') }}</strong>
                        <span>Acceso al sistema interno</span>
                    </div>
                </div>

                @yield('content')

                <p class="sm-auth-meta">
                    Acceso exclusivo para personal autorizado
                </p>
            </section>
        </main>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @include('sweetalert::alert')
    @stack('page_scripts')
</body>
</html>
