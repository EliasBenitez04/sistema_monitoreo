@extends('layouts.app')

@section('title', 'Detalle de stock | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de stock"
        subtitle="Información registrada de la carga de stock."
        icon="fas fa-boxes">
        <a href="{{ route('stocks.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('stocks.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
