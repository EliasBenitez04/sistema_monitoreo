@extends('layouts.app')

@section('title', 'Nuevo usuario | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nuevo usuario"
        subtitle="Registre un usuario del sistema."
        icon="fas fa-user">
        <a href="{{ route('users.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('sweetalert::alert')

        <div class="card sm-form-card">

            {!! Form::open(['route' => 'users.store','class' => 'confirm-submit']) !!}

            <div class="card-body">

                <div class="row">
                    @include('users.fields')
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Grabar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
