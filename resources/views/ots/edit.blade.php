@extends('layouts.app')

@section('title', 'Editar orden de trabajo | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar orden de trabajo"
        subtitle="Actualice la información de la orden de trabajo."
        icon="fas fa-clipboard-check">
        <a href="{{ route('ots.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card sm-form-card">

        {!! Form::model($ot, [
        'route' => ['ots.update', $ot->id_ot],
        'method' => 'patch'
        ]) !!}

        <div class="card-body">

            @include('sweetalert::alert')

            <div class="row">

                @include('ots.fields')

            </div>

        </div>

        <div class="card-footer d-flex justify-content-end">

            {!! Form::submit('Guardar', [
            'class' => 'btn btn-primary'
            ]) !!}

            <a href="{{ route('ots.index') }}"
                class="btn btn-default ml-2">Cancelar</a>

        </div>

        {!! Form::close() !!}

    </div>

</div>

@endsection