@extends('layouts.app')

@section('title', 'Pedidos mayoristas | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Pedidos mayoristas"
        subtitle="Registro, seguimiento, confirmación y documentación de pedidos comerciales."
        icon="fas fa-shopping-cart">
        <span class="badge badge-light px-3 py-2">
            <i class="fas fa-database mr-1"></i>
            {{ $pedido_compras->total() }} registros
        </span>
        <a class="btn btn-primary" href="{{ route('pedido_compras.create') }}">
            <i class="fas fa-plus"></i>
            Nuevo pedido
        </a>
    </x-page-header>

    <div class="content px-3 pedidos-page">
        @include('pedido_compras.table')
    </div>
@endsection
