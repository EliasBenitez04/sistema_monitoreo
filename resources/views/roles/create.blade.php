@extends('layouts.app')

@section('title', 'Nuevo rol | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nuevo rol"
        subtitle="Registre un rol y sus permisos asociados."
        icon="fas fa-user-shield">
        <a href="{{ route('roles.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open(['route' => 'roles.store','class' => 'confirm-submit']) !!}

            <div class="card-body">

                <div class="row">
                    @include('roles.fields')
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('roles.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

