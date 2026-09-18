@extends('layouts.app')

@section('title', 'Editar auditoría | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar auditoría"
        subtitle="Actualice la información de la auditoría."
        icon="fas fa-clipboard-check">
        <a href="{{ route('auditorias.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($auditoria, ['route' => ['auditorias.update', $auditoria->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('auditorias.fields')
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('auditorias.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
