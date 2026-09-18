@extends('layouts.app')

@section('title', 'Nueva carga de fotos | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nueva carga de fotos"
        subtitle="Registre una nueva carga de imágenes."
        icon="fas fa-images">
        <a href="{{ route('carga_fotos.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open([
                'route' => 'carga_fotos.store',
                'class' => 'confirm-submit',
                'files' => true,
            ]) !!}

            <div class="card-body">

                @include('sweetalert::alert')

                <div class="row">

                    @include('carga_fotos.fields')

                </div>

            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('carga_fotos.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
