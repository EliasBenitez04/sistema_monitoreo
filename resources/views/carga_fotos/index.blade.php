@extends('layouts.app')

@section('title', 'Imágenes cargadas | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Imágenes cargadas"
        subtitle="Consulta y administración de imágenes asociadas a órdenes de trabajo."
        icon="fas fa-images">
        <a class="btn btn-primary" href="{{ route('carga_fotos.create') }}">
            <i class="fas fa-plus"></i>
            Nueva imagen
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-data-card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="mb-2 mb-md-0">
                    <h3 class="card-title mb-0">Galería registrada</h3>
                    <small class="text-muted">Busque por OT, descripción o línea.</small>
                </div>

                <form method="GET" action="{{ route('carga_fotos.index') }}" class="sm-search-form">
                    <div class="input-group sm-search-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input
                            type="search"
                            class="form-control buscar-fotos js-remote-search"
                            name="search"
                            value="{{ request()->get('search', '') }}"
                            placeholder="Buscar imágenes..."
                            data-url="{{ route('carga_fotos.index') }}"
                            data-param="search"
                            data-target=".tabla-fotos-container">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body p-0 tabla-fotos-container">
                @include('carga_fotos.table', ['fotos' => $fotos])
            </div>
        </div>
    </div>
@endsection
