@extends('layouts.auth')

@section('title', 'Nueva contraseña | ' . config('app.name'))

@section('content')
    <h1 class="sm-auth-title">Definir nueva contraseña</h1>
    <p class="sm-auth-subtitle">Ingrese su correo y establezca una nueva contraseña.</p>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        @php
            if (!isset($token)) {
                $token = Request::route('token');
            }
        @endphp

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" id="email" name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                autocomplete="email" required>
            @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Nueva contraseña</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                autocomplete="new-password" required>
            @error('password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="form-control" autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Actualizar contraseña
        </button>
    </form>

    <div class="sm-auth-footer">
        <a href="{{ route('login') }}">Volver al inicio de sesión</a>
    </div>
@endsection
