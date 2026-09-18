@extends('layouts.app')

@section('content')
    <x-page-header
        title="Detalle del cliente"
        subtitle="Información registrada para este cliente."
        icon="fas fa-user">
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
