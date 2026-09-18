@extends('layouts.app')

@section('title', 'Artículos | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Artículos"
        subtitle="Catálogo maestro de productos utilizados por los procesos operativos."
        icon="fas fa-box-open">
        @can('articulos create')
            <a class="btn btn-primary" href="{{ route('articulos.create') }}">
                <i class="fas fa-plus"></i>
                Nuevo artículo
            </a>
        @endcan
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Catálogo de artículos</h3>
                    <small class="text-muted">Consulte, edite y mantenga actualizada la información de productos.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('articulos.table')
            </div>
        </div>
    </div>
@endsection
