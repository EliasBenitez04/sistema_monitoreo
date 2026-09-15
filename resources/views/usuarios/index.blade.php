@extends('layouts.app')

@section('content')
    <x-page-header
        title="Usuarios"
        subtitle="Administración de cuentas, acceso y perfiles operativos."
        icon="fas fa-users-cog">
        <a class="btn btn-primary" href="{{ route('usuarios.create') }}">
            <i class="fas fa-user-plus"></i>
            Nuevo usuario
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('sweetalert::alert')

        <div class="card sm-data-card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="mb-2 mb-md-0">
                    <h3 class="card-title mb-0">Directorio de usuarios</h3>
                    <small class="text-muted">Busque cuentas y gestione sus datos de acceso.</small>
                </div>
                <div style="min-width: 280px; max-width: 420px; width: 100%;">
                    @includeIf('layouts.buscador', ['url' => url()->current()])
                </div>
            </div>

            <div id="tabla-container" class="card-body p-0 tabla-container">
                @include('usuarios.table')
            </div>
        </div>
    </div>
@endsection
