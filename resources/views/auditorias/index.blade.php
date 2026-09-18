@extends('layouts.app')

@section('title', 'Auditoría | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Auditoría"
        subtitle="Historial de acciones y trazabilidad del sistema."
        icon="fas fa-clipboard-list" />

    <div class="content px-3">
        @include('flash::message')

        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Registros de auditoría</h3>
                    <small class="text-muted">Eventos registrados por el sistema.</small>
                </div>
            </div>

            <div class="card-body p-0">
                @if ($auditorias->isEmpty())
                    <div class="sm-empty-state">
                        <i class="fas fa-inbox"></i>
                        <p class="mb-0">No se encontraron registros.</p>
                    </div>
                @else
                    @include('auditorias.table')
                @endif
            </div>
        </div>
    </div>
@endsection
