<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f172a">
    <title>Ingresar · {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <style>
        .sm-login-page {
            min-height: 100vh;
            margin: 0;
            display: grid;
            grid-template-columns: minmax(360px, .9fr) minmax(520px, 1.25fr);
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
        }

        .sm-login-brand {
            position: relative;
            padding: 58px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            color: #fff;
            background:
                radial-gradient(circle at 15% 10%, rgba(59, 130, 246, .40), transparent 32%),
                radial-gradient(circle at 90% 85%, rgba(14, 165, 233, .20), transparent 35%),
                linear-gradient(145deg, #0f172a 0%, #172554 52%, #1e3a8a 100%);
        }

        .sm-login-brand::before,
        .sm-login-brand::after {
            content: '';
            position: absolute;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 50%;
            pointer-events: none;
        }

        .sm-login-brand::before {
            width: 440px;
            height: 440px;
            right: -230px;
            top: -150px;
        }

        .sm-login-brand::after {
            width: 620px;
            height: 620px;
            left: -350px;
            bottom: -390px;
        }

        .sm-login-logo {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .sm-login-logo img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 13px;
            border: 1px solid rgba(255, 255, 255, .16);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .18);
        }

        .sm-login-logo strong {
            display: block;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: -.2px;
        }

        .sm-login-logo span {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .75px;
            text-transform: uppercase;
        }

        .sm-login-brand-copy {
            position: relative;
            z-index: 1;
            max-width: 520px;
        }

        .sm-login-eyebrow {
            margin-bottom: 14px;
            color: #93c5fd;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .sm-login-brand h1 {
            margin: 0;
            max-width: 480px;
            font-size: clamp(34px, 4.2vw, 58px);
            line-height: 1.04;
            font-weight: 800;
            letter-spacing: -2.2px;
        }

        .sm-login-brand-copy p {
            max-width: 450px;
            margin: 22px 0 0;
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.75;
        }

        .sm-login-features {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 30px;
        }

        .sm-login-feature {
            padding: 8px 11px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #dbeafe;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .09);
            border-radius: 999px;
            font-size: 10px;
            font-weight: 650;
        }

        .sm-login-brand-footer {
            position: relative;
            z-index: 1;
            color: #64748b;
            font-size: 10px;
        }

        .sm-login-access {
            padding: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }

        .sm-login-panel {
            width: 100%;
            max-width: 430px;
        }

        .sm-login-panel__mobile-brand {
            display: none;
            margin-bottom: 34px;
        }

        .sm-login-panel__mobile-brand img {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 12px;
        }

        .sm-login-panel h2 {
            margin: 0;
            color: #0f172a;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.75px;
        }

        .sm-login-panel__subtitle {
            margin: 9px 0 30px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .sm-login-panel .form-group {
            margin-bottom: 20px;
        }

        .sm-login-panel label {
            margin-bottom: 7px;
            color: #334155;
            font-size: 11px;
            font-weight: 750;
        }

        .sm-login-field {
            position: relative;
        }

        .sm-login-field .form-control {
            height: 48px;
            padding-left: 42px;
            padding-right: 42px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #fff;
            color: #0f172a;
            font-size: 12px;
        }

        .sm-login-field .form-control:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .10);
        }

        .sm-login-field__icon {
            position: absolute;
            top: 50%;
            left: 14px;
            z-index: 3;
            width: 16px;
            color: #64748b;
            transform: translateY(-50%);
            text-align: center;
        }

        .sm-login-password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            z-index: 3;
            width: 30px;
            height: 30px;
            padding: 0;
            color: #64748b;
            background: transparent;
            border: 0;
            border-radius: 7px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .sm-login-password-toggle:hover {
            color: #2563eb;
            background: #eff6ff;
        }

        .sm-login-submit {
            width: 100%;
            min-height: 48px;
            margin-top: 5px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 750;
            box-shadow: 0 10px 24px rgba(37, 99, 235, .20) !important;
        }

        .sm-login-security {
            margin-top: 20px;
            padding-top: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            font-size: 10px;
        }

        .sm-login-security i {
            color: #16a34a;
        }

        @media (max-width: 900px) {
            .sm-login-page {
                grid-template-columns: 1fr;
            }

            .sm-login-brand {
                display: none;
            }

            .sm-login-access {
                min-height: 100vh;
                padding: 30px 22px;
            }

            .sm-login-panel__mobile-brand {
                display: flex;
                align-items: center;
                gap: 11px;
                color: #0f172a;
                font-size: 13px;
                font-weight: 800;
            }
        }
    </style>
</head>

<body class="sm-login-page">
    <section class="sm-login-brand" aria-label="Presentación del sistema">
        <div class="sm-login-logo">
            <img src="{{ asset('storage/logos/gts_logo.jpg') }}" alt="Logo">
            <div>
                <strong>{{ config('app.name') }}</strong>
                <span>Gestión operativa</span>
            </div>
        </div>

        <div class="sm-login-brand-copy">
            <div class="sm-login-eyebrow">Plataforma empresarial</div>
            <h1>Información clara para operar mejor.</h1>
            <p>
                Centralice seguimiento de OT, stock, redistribución, logística y procesos operativos
                en un entorno seguro y trazable.
            </p>

            <div class="sm-login-features">
                <span class="sm-login-feature"><i class="fas fa-chart-line"></i> Monitoreo</span>
                <span class="sm-login-feature"><i class="fas fa-route"></i> Trazabilidad</span>
                <span class="sm-login-feature"><i class="fas fa-shield-alt"></i> Control de acceso</span>
            </div>
        </div>

        <div class="sm-login-brand-footer">
            Sistema interno · Acceso exclusivo para personal autorizado
        </div>
    </section>

    <main class="sm-login-access">
        <div class="sm-login-panel">
            <div class="sm-login-panel__mobile-brand">
                <img src="{{ asset('storage/logos/gts_logo.jpg') }}" alt="Logo">
                <span>{{ config('app.name') }}</span>
            </div>

            <h2>Bienvenido</h2>
            <p class="sm-login-panel__subtitle">Ingrese sus credenciales para acceder al centro de operaciones.</p>

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Usuario</label>
                    <div class="sm-login-field">
                        <i class="fas fa-user sm-login-field__icon"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="form-control text-uppercase @error('name') is-invalid @enderror"
                            placeholder="USUARIO" autocomplete="username" required autofocus
                            oninput="this.value = this.value.toUpperCase();">
                    </div>
                    @error('name')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="sm-login-field">
                        <i class="fas fa-lock sm-login-field__icon"></i>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese su contraseña" autocomplete="current-password" required>
                        <button type="button" class="sm-login-password-toggle" onclick="togglePassword()"
                            aria-label="Mostrar u ocultar contraseña">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary sm-login-submit">
                    Ingresar al sistema <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>

            <div class="sm-login-security">
                <i class="fas fa-check-circle"></i>
                <span>Conexión protegida · {{ date('Y') }} {{ config('app.name') }}</span>
            </div>
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
    @include('sweetalert::alert')

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            const visible = password.type === 'text';

            password.type = visible ? 'password' : 'text';
            icon.classList.toggle('fa-eye', visible);
            icon.classList.toggle('fa-eye-slash', !visible);
        }
    </script>
</body>

</html>
