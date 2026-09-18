@extends('layouts.app')

@section('title', 'Detalle del pedido | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle del pedido"
        subtitle="Información registrada del pedido de compra."
        icon="fas fa-shopping-cart">
        <a href="{{ route('pedido_compras.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    @include('pedido_compras.show_fields')
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('pedido_compras.index') }}" class="btn btn-secondary">
                    <i class="fa fa-list"></i> Ver Todos Los Pedidos
                </a>
            </div>
        </div>
    </div>
@endsection
