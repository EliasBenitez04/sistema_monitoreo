@extends('layouts.app')

@section('title', 'Nuevo artículo | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nuevo artículo"
        subtitle="Registre la información del artículo."
        icon="fas fa-box-open">
        <a href="{{ route('articulos.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open(['route' => 'articulos.store','class' => 'confirm-submit' ]) !!}

            <div class="card-body">
                @include('sweetalert::alert')

                <div class="row">
                    @include('articulos.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('articulos.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
