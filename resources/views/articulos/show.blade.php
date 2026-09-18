@extends('layouts.app')

@section('title', 'Detalle del artículo | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle del artículo"
        subtitle="Información registrada del artículo."
        icon="fas fa-box-open">
        <a href="{{ route('articulos.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('articulos.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
