@extends('layouts.app')

@section('content')
    <x-page-header
        title="Nuevo cliente"
        subtitle="Registre los datos comerciales y de contacto del cliente."
        icon="fas fa-user-plus">
        <a href="{{ route('clientes.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('sweetalert::alert')

        <div class="card sm-form-card">
            {!! Form::open([
                'route' => 'clientes.store',
                'class' => 'confirm-submit',
                'files' => true,
            ]) !!}

            <div class="card-body">
                <div class="row">
                    @include('clientes.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end flex-wrap">
                <a href="{{ route('clientes.index') }}" class="btn btn-default">
                    Cancelar
                </a>
                {!! Form::submit('Guardar cliente', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
