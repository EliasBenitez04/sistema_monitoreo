@extends('layouts.auth')

@section('title', 'Confirmar contraseña | ' . config('app.name'))

@section('content')
    <h1 class="sm-auth-title">Confirmar contraseña</h1>
    <p class="sm-auth-subtitle">Por seguridad, confirme su contraseña antes de continuar.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                autocomplete="current-password" required>
            @error('password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Confirmar
        </button>
    </form>

    @if (Route::has('password.request'))
        <div class="sm-auth-footer">
            <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
        </div>
    @endif
@endsection
