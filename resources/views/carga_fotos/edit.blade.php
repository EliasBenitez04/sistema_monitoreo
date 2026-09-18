@extends('layouts.app')

@section('title', 'Editar carga de fotos | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar carga de fotos"
        subtitle="Actualice la información de la carga."
        icon="fas fa-images">
        <a href="{{ route('carga_fotos.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($foto, [
                'route' => ['carga_fotos.update', $foto->fot_cod],
                'method' => 'patch',
                'files' => true,
                'data-edit' => 'true',
            ]) !!}

            <div class="card-body">

                @include('sweetalert::alert')

                <div class="row">

                    @include('carga_fotos.fields')

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('carga_fotos.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
