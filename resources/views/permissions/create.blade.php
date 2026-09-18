@extends('layouts.app')

@section('title', 'Nuevo permiso | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nuevo permiso"
        subtitle="Registre un permiso del sistema."
        icon="fas fa-key">
        <a href="{{ route('permissions.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    @include('sweetalert::alert')

    <div class="content px-3">
        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">
            {!! Form::open(['route' => 'permissions.store','class' => 'confirm-submit']) !!}
            <div class="card-body">
                <div class="row">
                    @include('permissions.fields')
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('permissions.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
