@extends('layouts.app')

@section('title', 'Nuevo cliente | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nuevo cliente"
        subtitle="Registre la información comercial y de contacto."
        icon="fas fa-user-friends">
        <a href="{{ route('clientes.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open([
                'route' => 'clientes.store',
                'class' => 'confirm-submit',
                'files' => true,
            ]) !!}

            <div class="card-body">
                @include('sweetalert::alert')


                <div class="row">
                    @include('clientes.fields')
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('clientes.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
