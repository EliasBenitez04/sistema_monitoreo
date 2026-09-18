@extends('layouts.auth')

@section('title', 'Iniciar sesión | ' . config('app.name'))

@section('content')
    <h1 class="sm-auth-title">Iniciar sesión</h1>
    <p class="sm-auth-subtitle">Ingrese sus credenciales para acceder al sistema.</p>

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="form-group">
            <label for="name">Usuario</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control text-uppercase @error('name') is-invalid @enderror"
                    placeholder="Usuario"
                    autocomplete="username"
                    required
                    autofocus
                    oninput="this.value = this.value.toUpperCase();">
            </div>
            @error('name')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Contraseña"
                    autocomplete="current-password"
                    required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-default" id="togglePassword" aria-label="Mostrar u ocultar contraseña">
                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-sign-in-alt"></i>
            Ingresar
        </button>
    </form>

    @if (Route::has('password.request'))
        <div class="sm-auth-footer">
            <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
        </div>
    @endif
@endsection

@push('page_scripts')
    <script>
        document.getElementById('togglePassword')?.addEventListener('click', function () {
            const input = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            const showing = input.type === 'text';

            input.type = showing ? 'password' : 'text';
            icon.classList.toggle('fa-eye', showing);
            icon.classList.toggle('fa-eye-slash', !showing);
        });
    </script>
@endpush
