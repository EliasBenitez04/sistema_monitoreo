@extends('layouts.app')

@section('title', 'Detalle de configuración de redistribución | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de configuración"
        subtitle="Parámetros registrados para el motor de redistribución."
        icon="fas fa-sliders-h">
        <a href="{{ route('redistribucion-configs.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
        <a href="{{ route('redistribucion-configs.edit', $redistribucionConfig->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i>
            Editar
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('redistribucion_configs.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
