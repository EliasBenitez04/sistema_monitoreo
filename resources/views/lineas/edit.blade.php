@extends('layouts.app')

@section('title', 'Editar línea | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar línea"
        subtitle="Actualice la información de la línea."
        icon="fas fa-tags">
        <a href="{{ route('lineas.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($linea, ['route' => ['lineas.update', $linea->linea_cod], 'method' => 'patch', 'data-confirm' => 'confirm-submit']) !!}

            <div class="card-body">
                @include('sweetalert::alert')
                <div class="row">
                    @include('lineas.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('lineas.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
