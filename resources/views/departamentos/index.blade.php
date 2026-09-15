@extends('layouts.app')

@section('content')
    <x-page-header
        title="Departamentos"
        subtitle="Estructura geográfica utilizada por sucursales, clientes y operaciones."
        icon="fas fa-map-marked-alt">
        @can('departamentos create')
            <a class="btn btn-primary" href="{{ route('Departamentos.create') }}">
                <i class="fas fa-plus"></i>
                Nuevo departamento
            </a>
        @endcan
    </x-page-header>

    <div class="content px-3">
        @include('sweetalert::alert')

        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Departamentos registrados</h3>
                    <small class="text-muted">Base territorial disponible para los demás maestros del sistema.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('departamentos.table')
            </div>
        </div>
    </div>
@endsection
