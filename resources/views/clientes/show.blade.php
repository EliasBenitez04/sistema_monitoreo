@extends('layouts.app')

@section('title', 'Detalle del cliente | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle del cliente"
        subtitle="Información registrada del cliente."
        icon="fas fa-user-friends">
        <a href="{{ route('clientes.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('clientes.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
