@extends('layouts.app')

@section('title', 'Editar permiso | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar permiso"
        subtitle="Actualice el permiso seleccionado."
        icon="fas fa-key">
        <a href="{{ route('permissions.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        
        @include('adminlte-templates::common.errors')
        @include('sweetalert::alert')
        
        <div class="card sm-form-card">

            {!! Form::model($permissions, ['route' => ['permissions.update', $permissions->id], 'method' => 'patch']) !!}


            <div class="card-body">
                <div class="row">
                    @include('permissions.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('permissions.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
