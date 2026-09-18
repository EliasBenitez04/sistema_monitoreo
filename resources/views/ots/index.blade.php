@extends('layouts.app')

@section('title', 'Órdenes de trabajo | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Órdenes de trabajo"
        subtitle="Importación, consulta y acceso rápido al seguimiento de OT."
        icon="fas fa-clipboard-check">
        <form action="{{ route('ots.buscarEditar') }}" method="GET">
            <div class="input-group sm-search-group">
                <input
                    type="number"
                    name="nro_ot"
                    class="form-control"
                    placeholder="N° de OT"
                    min="1"
                    required
                    aria-label="Número de orden de trabajo">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Buscar OT
                    </button>
                </div>
            </div>
        </form>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Importación y seguimiento</h3>
                    <small class="text-muted">Gestione la información base utilizada por los dashboards y la trazabilidad.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('ots.table')
            </div>
        </div>
    </div>
@endsection
