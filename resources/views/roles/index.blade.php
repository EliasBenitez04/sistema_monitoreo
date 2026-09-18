@extends('layouts.app')

@section('title', 'Roles | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Roles"
        subtitle="Defina perfiles de acceso y agrupe permisos según responsabilidades."
        icon="fas fa-user-shield">
        @can('roles create')
            <a class="btn btn-primary" href="{{ route('roles.create') }}">
                <i class="fas fa-plus"></i>
                Nuevo rol
            </a>
        @endcan
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Roles configurados</h3>
                    <small class="text-muted">Controle qué funciones puede utilizar cada perfil del sistema.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('roles.table')
            </div>
        </div>
    </div>
@endsection
