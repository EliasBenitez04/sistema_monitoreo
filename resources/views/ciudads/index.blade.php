@extends('layouts.app')

@section('content')
    <x-page-header
        title="Ciudades"
        subtitle="Catálogo geográfico vinculado a departamentos y operaciones comerciales."
        icon="fas fa-city">
        @can('ciudades create')
            <a class="btn btn-primary" href="{{ route('ciudades.create') }}">
                <i class="fas fa-plus"></i>
                Nueva ciudad
            </a>
        @endcan
    </x-page-header>

    <div class="content px-3">
        @include('sweetalert::alert')

        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Ciudades registradas</h3>
                    <small class="text-muted">Consulte y mantenga las localidades disponibles en el sistema.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('ciudads.table')
            </div>
        </div>
    </div>
@endsection
