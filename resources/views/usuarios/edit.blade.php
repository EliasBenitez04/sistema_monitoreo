@extends('layouts.app')

@section('title', 'Editar usuario | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar usuario"
        subtitle="Actualice los datos y permisos del usuario."
        icon="fas fa-users">
        <a href="{{ route('usuarios.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($usuario, ['route' => ['usuarios.update', $usuario->id], 'method' => 'patch']) !!}

            <div class="card-body">

                @include('sweetalert::alert')

                <div class="row">

                    @include('usuarios.fields')

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('usuarios.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
