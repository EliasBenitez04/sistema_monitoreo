@extends('layouts.app')

@section('title', 'Editar carga de stock | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar carga de stock"
        subtitle="Actualice la información de la carga de stock."
        icon="fas fa-boxes">
        <a href="{{ route('stocks.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($stock, ['route' => ['stocks.update', $stock->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('stocks.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('stocks.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
