@extends('layouts.app')

@section('title', 'Sucursales | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Sucursales"
        subtitle="Puntos operativos utilizados para stock, ventas y redistribución."
        icon="fas fa-store">
        <a class="btn btn-primary" href="{{ route('sucursal.create') }}">
            <i class="fas fa-plus"></i>
            Nueva sucursal
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-data-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Directorio de sucursales</h3>
                    <small class="text-muted">Mantenga actualizada la estructura territorial del sistema.</small>
                </div>
            </div>
            <div class="card-body p-0">
                @include('sucursals.table')
            </div>
        </div>
    </div>
@endsection
