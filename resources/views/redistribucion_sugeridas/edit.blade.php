@extends('layouts.app')

@section('title', 'Editar sugerencia de redistribución | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar sugerencia de redistribución"
        subtitle="Actualice la información de la redistribución."
        icon="fas fa-exchange-alt">
        <a href="{{ route('RedistribucionSugeridas.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($redistribucionSugerida, ['route' => ['redistribucionSugeridas.update', $redistribucionSugerida->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('redistribucion__sugeridas.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('redistribucionSugeridas.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
