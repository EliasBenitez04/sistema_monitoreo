@extends('layouts.app')

@section('title', 'Detalle de redistribución | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de redistribución"
        subtitle="Información registrada de la sugerencia."
        icon="fas fa-exchange-alt">
        <a href="{{ route('RedistribucionSugeridas.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('redistribucion__sugeridas.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
