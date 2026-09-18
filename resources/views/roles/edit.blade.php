@extends('layouts.app')

@section('title', 'Editar rol | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar rol"
        subtitle="Actualice el rol y sus permisos."
        icon="fas fa-user-shield">
        <a href="{{ route('roles.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('roles.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('roles.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

