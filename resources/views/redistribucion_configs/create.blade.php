@extends('layouts.app')

@section('title', 'Nueva configuración de redistribución | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nueva configuración"
        subtitle="Defina los parámetros utilizados por el motor de redistribución."
        icon="fas fa-sliders-h">
        <a href="{{ route('redistribucion-configs.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">
            {!! Form::open(['route' => 'redistribucion-configs.store', 'class' => 'confirm-submit']) !!}

            <div class="card-body">
                <div class="row">
                    @include('redistribucion_configs.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('redistribucion-configs.index') }}" class="btn btn-default mr-2">Cancelar</a>
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
