@extends('layouts.app')

@section('content')
    <x-page-header
        title="Importación de stock"
        subtitle="Carga y control de información de existencias para los procesos de monitoreo."
        icon="fas fa-boxes" />

    <div class="content px-3">
        @include('sweetalert::alert')

        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Datos de stock</h3>
                    <small class="text-muted">Revise el estado de las cargas y ejecute las acciones disponibles.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('stocks.table')
            </div>
        </div>
    </div>
@endsection
