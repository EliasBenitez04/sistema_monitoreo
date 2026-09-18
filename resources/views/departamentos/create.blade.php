@extends('layouts.app')

@section('title', 'Nuevo departamento | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nuevo departamento"
        subtitle="Registre un departamento para la gestión territorial."
        icon="fas fa-map-marked-alt">
        <a href="{{ route('Departamentos.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open(['route' => 'Departamentos.store','class' => 'confirm-submit']) !!}

            <div class="card-body">

                @include('sweetalert::alert')

                <div class="row">

                    @include('departamentos.fields')
                    
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end">

                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('Departamentos.index') }}" class="btn btn-default ml-2">Cancelar</a>

            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
