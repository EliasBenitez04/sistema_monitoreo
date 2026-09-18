@extends('layouts.app')

@section('title', 'Detalle de departamento | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de departamento"
        subtitle="Información registrada del departamento."
        icon="fas fa-map-marked-alt">
        <a href="{{ route('Departamentos.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('departamentos.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
