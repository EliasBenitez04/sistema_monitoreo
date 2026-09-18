@extends('layouts.app')

@section('title', 'Líneas | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Líneas"
        subtitle="Clasificación de productos para catálogo, análisis y seguimiento."
        icon="fas fa-tags">
        <a class="btn btn-primary" href="{{ route('lineas.create') }}">
            <i class="fas fa-plus"></i>
            Nueva línea
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Líneas registradas</h3>
                    <small class="text-muted">Organice las familias utilizadas por los módulos de producto y monitoreo.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('lineas.table')
            </div>
        </div>
    </div>
@endsection
