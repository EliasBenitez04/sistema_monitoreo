@extends('layouts.auth')

@section('title', 'Recuperar contraseña | ' . config('app.name'))

@section('content')
    <h1 class="sm-auth-title">Recuperar contraseña</h1>
    <p class="sm-auth-subtitle">Ingrese su correo para recibir el enlace de recuperación.</p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Correo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    autocomplete="email" required autofocus>
            </div>
            @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Enviar enlace
        </button>
    </form>

    <div class="sm-auth-footer">
        <a href="{{ route('login') }}">Volver al inicio de sesión</a>
    </div>
@endsection
