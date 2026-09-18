@extends('layouts.app')

@section('title', 'Configuración de redistribución | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Configuración de redistribución"
        subtitle="Parámetros utilizados por el motor de sugerencias."
        icon="fas fa-sliders-h">
        <a class="btn btn-primary" href="{{ route('redistribucion-configs.create') }}">
            <i class="fas fa-plus"></i>
            Nueva configuración
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('flash::message')

        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Parámetros activos</h3>
                    <small class="text-muted">Valores configurados para el análisis de redistribución.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('redistribucion_configs.table')
            </div>
        </div>
    </div>
@endsection
