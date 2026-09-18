@extends('layouts.auth')

@section('title', 'Registro | ' . config('app.name'))

@section('content')
    <h1 class="sm-auth-title">Crear cuenta</h1>
    <p class="sm-auth-subtitle">Complete los datos para registrar un nuevo usuario.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" autocomplete="name" required>
            @error('name')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo / usuario</label>
            <input type="text" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" autocomplete="email" required>
            @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
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
            <i class="fas fa-user-plus"></i>
            Registrar
        </button>
    </form>

    <div class="sm-auth-footer">
        <a href="{{ route('login') }}">Ya tengo una cuenta</a>
    </div>
@endsection
