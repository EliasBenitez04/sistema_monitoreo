@extends('layouts.app')

@section('title', 'Usuarios | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Usuarios"
        subtitle="Listado y búsqueda de cuentas registradas."
        icon="fas fa-users">
        <a class="btn btn-primary" href="{{ route('users.create') }}">
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
                    <small class="text-muted">Busque por nombre, correo, documento o rol.</small>
                </div>

                <div class="sm-table-search">
                    @includeIf('layouts.buscador', [
                        'url' => route('users.index'),
                        'target' => '#tabla-container',
                    ])
                </div>
            </div>

            <div class="card-body p-0" id="tabla-container">
                @include('users.table')
            </div>
        </div>
    </div>
@endsection
