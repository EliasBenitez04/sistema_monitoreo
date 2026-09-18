@extends('layouts.app')

@section('content')
    <x-page-header
        title="Editar cliente"
        subtitle="Actualice la información comercial y de contacto."
        icon="fas fa-user-edit">
        <a href="{{ route('clientes.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('sweetalert::alert')

        <div class="card sm-form-card">
            {!! Form::model($cliente, [
                'route' => ['clientes.update', $cliente->id_cliente],
                'method' => 'patch',
                'class' => 'confirm-submit',
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
                {!! Form::submit('Actualizar cliente', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
