@extends('layouts.app')

@section('title', 'Nueva carga de ventas y stock | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nueva carga de ventas y stock"
        subtitle="Registre una nueva carga de información por sucursal."
        icon="fas fa-chart-line">
        <a href="{{ route('stock_ventas_sucursales.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open(['route' => 'stock_ventas_sucursales.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('stock_ventas_sucursales.fields')
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('stock_ventas_sucursales.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
