@extends('layouts.app')

@section('title', 'Nueva sugerencia de redistribución | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nueva sugerencia de redistribución"
        subtitle="Registre la información requerida para la redistribución."
        icon="fas fa-exchange-alt">
        <a href="{{ route('RedistribucionSugeridas.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open(['route' => 'RedistribucionSugeridas.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('Redistribucion_Sugeridas.fields')
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('Redistribucion_Sugeridas.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
