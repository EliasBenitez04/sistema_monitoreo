@extends('layouts.app')

@section('content')
    <x-page-header
        title="Permisos"
        subtitle="Catálogo de capacidades disponibles para roles y usuarios autorizados."
        icon="fas fa-key">
        <a class="btn btn-primary" href="{{ route('permissions.create') }}">
            <i class="fas fa-plus"></i>
            Nuevo permiso
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('sweetalert::alert')

        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Permisos del sistema</h3>
                    <small class="text-muted">Mantenga organizada la matriz de autorización de la aplicación.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('permissions.table')
            </div>
        </div>
    </div>
@endsection
