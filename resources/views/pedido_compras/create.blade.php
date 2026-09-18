@extends('layouts.app')

@section('title', 'Nuevo pedido de compra | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Nuevo pedido de compra"
        subtitle="Registre un nuevo pedido de compra."
        icon="fas fa-shopping-cart">
        <a href="{{ route('pedido_compras.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>


    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card sm-form-card">

            {!! Form::open([
                'route' => 'pedido_compras.store',
                'class' => 'confirm-submit',
                'id' => 'form-pedido',
            ]) !!}

            <div class="card-body">

                @include('sweetalert::alert')

                <div class="row">

                    @include('pedido_compras.fields')

                </div>

            </div>


            <div class="card-footer d-flex justify-content-end">

                {!! Form::submit('Guardar', [
                    'class' => 'btn btn-primary',
                ]) !!}

                <a href="{{ route('pedido_compras.index') }}" class="btn btn-default ml-2">Cancelar</a>

            </div>

            {!! Form::close() !!}


            {{-- =====================================================
                 MODAL NUEVO CLIENTE

                 IMPORTANTE:
                 Está FUERA del formulario del pedido
                 ===================================================== --}}

            @include('pedido_compras.modal_cliente')


        </div>

    </div>
@endsection
