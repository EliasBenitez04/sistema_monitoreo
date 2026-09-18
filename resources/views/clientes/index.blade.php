@extends('layouts.app')

@section('title', 'Clientes | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Clientes"
        subtitle="Administración centralizada de clientes y datos comerciales."
        icon="fas fa-user-friends">
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Nuevo cliente
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Clientes registrados</h3>
                    <small class="text-muted">Información disponible para pedidos y procesos comerciales.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('clientes.table')
            </div>
        </div>
    </div>
@endsection
