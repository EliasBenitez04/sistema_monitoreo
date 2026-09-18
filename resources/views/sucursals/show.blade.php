@extends('layouts.app')

@section('title', 'Detalle de sucursal | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de sucursal"
        subtitle="Información registrada de la sucursal."
        icon="fas fa-store">
        <a href="{{ route('sucursal.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('sucursals.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
