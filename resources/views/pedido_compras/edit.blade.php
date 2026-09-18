@extends('layouts.app')

@section('title', 'Editar pedido de compra | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Editar pedido de compra"
        subtitle="Actualice la información del pedido."
        icon="fas fa-shopping-cart">
        <a href="{{ route('pedido_compras.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::model($pedido_compras, [
                'route' => ['pedido_compras.update', $pedido_compras->id_pedido],
                'method' => 'patch',
                'id' => 'formPedido',
                'class' => 'confirm-submit',
            ]) !!}

            <div class="card-body">
                @include('sweetalert::alert')

                <div class="row">

                    {{-- 🔥 IMPORTANTE: PASAR DETALLE AL FORM --}}
                    @php
                        $pedido = $pedido_compras;
                        $detalles = $detalle ?? [];
                    @endphp

                    @include('pedido_compras.fields')

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('pedido_compras.index') }}" class="btn btn-default ml-2">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
