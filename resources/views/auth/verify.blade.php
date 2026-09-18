@extends('layouts.auth')

@section('title', 'Verificar correo | ' . config('app.name'))

@section('content')
    <h1 class="sm-auth-title">Verifique su correo</h1>
    <p class="sm-auth-subtitle">Revise su bandeja de entrada para continuar con el acceso.</p>

    @if (session('resent'))
        <div class="alert alert-success">
            Se envió un nuevo enlace de verificación.
        </div>
    @endif

    <p class="mb-3">
        Antes de continuar, revise el enlace enviado a su dirección de correo.
    </p>

    <a href="#" class="btn btn-primary btn-block"
        onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
        Reenviar enlace
    </a>

    <form id="resend-form" action="{{ route('verification.resend') }}" method="POST" class="d-none">
        @csrf
    </form>
@endsection
