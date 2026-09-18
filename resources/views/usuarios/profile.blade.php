@extends('layouts.app')

@section('title', 'Mi perfil | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Mi perfil"
        subtitle="Información de la cuenta y opciones de seguridad."
        icon="fas fa-user">
        <a href="{{ route('home') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('sweetalert::alert')
        @include('adminlte-templates::common.errors')

        <div class="sm-profile-layout">
            <div class="card">
                <div class="sm-profile-summary">
                    <div class="sm-profile-initials">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <h3>{{ auth()->user()->name }}</h3>
                    <p>{{ auth()->user()->email }}</p>

                    <div class="sm-profile-data">
                        <div class="sm-profile-data__item">
                            <span class="sm-profile-data__label">Documento</span>
                            <span class="sm-profile-data__value">
                                {{ auth()->user()->ci ?? auth()->user()->nro_documento ?? '—' }}
                            </span>
                        </div>

                        <div class="sm-profile-data__item">
                            <span class="sm-profile-data__label">Dirección</span>
                            <span class="sm-profile-data__value">{{ auth()->user()->direccion ?: '—' }}</span>
                        </div>

                        <div class="sm-profile-data__item">
                            <span class="sm-profile-data__label">Teléfono</span>
                            <span class="sm-profile-data__value">
                                {{ auth()->user()->telefono ?? auth()->user()->celular ?? '—' }}
                            </span>
                        </div>

                        <div class="sm-profile-data__item">
                            <span class="sm-profile-data__label">Estado</span>
                            <span class="sm-profile-data__value">{{ auth()->user()->estado ?? 'Activo' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card sm-form-card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title mb-0">Cambiar contraseña</h3>
                        <small class="text-muted">La nueva contraseña debe tener al menos 6 caracteres.</small>
                    </div>
                </div>

                <form action="{{ url('users/perfil/cambiar-password') }}" method="POST" class="confirm-submit">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="password">Nueva contraseña</label>
                            <input type="password" id="password" name="password" class="form-control"
                                autocomplete="new-password" required>
                        </div>

                        <div class="form-group mb-0">
                            <label for="confirm-password">Confirmar contraseña</label>
                            <input type="password" id="confirm-password" name="confirm-password" class="form-control"
                                autocomplete="new-password" required>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-lock"></i>
                            Actualizar contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
