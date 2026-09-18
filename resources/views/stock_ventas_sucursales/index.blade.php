@extends('layouts.app')

@section('title', 'Stock y ventas por sucursal | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Stock y ventas por sucursal"
        subtitle="Fuente de datos utilizada para análisis de demanda y redistribución."
        icon="fas fa-chart-bar">
        <a class="btn btn-primary" href="{{ route('stock_ventas_sucursales.create') }}">
            <i class="fas fa-plus"></i>
            Nueva carga
        </a>
    </x-page-header>

    <div class="content px-3">
        @include('stock_ventas_sucursales.table')
    </div>
@endsection
