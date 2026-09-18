@extends('layouts.app')

@section('title', 'Editar sucursal | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar sucursal"
        subtitle="Actualice la información de la sucursal."
        icon="fas fa-store">
        <a href="{{ route('sucursal.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($sucursal, ['route' => ['sucursal.update', $sucursal->cod_suc], 'method' => 'patch', 'class' => 'confirm-submit']) !!}

            <div class="card-body">
                @include('sweetalert::alert')
                <div class="row">
                    @include('sucursals.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('sucursal.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
