@extends('layouts.app')

@section('title', 'Detalle de ventas y stock | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de ventas y stock"
        subtitle="Información registrada de la carga."
        icon="fas fa-chart-line">
        <a href="{{ route('stock_ventas_sucursales.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('stock_ventas_sucursales.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
