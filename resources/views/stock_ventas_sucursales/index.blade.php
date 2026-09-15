@extends('layouts.app')

@section('content')
    <x-page-header
        title="Stock y ventas por sucursal"
        subtitle="Fuente de datos utilizada para análisis de demanda y redistribución."
        icon="fas fa-chart-bar">
        <a class="btn btn-primary" href="{{ route('stock_ventas_sucursales.create') }}">
            <i class="fas fa-plus"></i>
            Nueva carga
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('sweetalert::alert')

        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Información consolidada</h3>
                    <small class="text-muted">Consulte los registros cargados antes de ejecutar análisis de redistribución.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('stock_ventas_sucursales.table')
            </div>
        </div>
    </div>
@endsection
