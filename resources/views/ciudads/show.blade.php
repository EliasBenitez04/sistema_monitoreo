@extends('layouts.app')

@section('title', 'Detalle de ciudad | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de ciudad"
        subtitle="Información registrada de la ciudad."
        icon="fas fa-city">
        <a href="{{ route('ciudades.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('ciudads.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
