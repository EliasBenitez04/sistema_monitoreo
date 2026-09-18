@extends('layouts.app')

@section('title', 'Detalle de línea | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de línea"
        subtitle="Información registrada de la línea."
        icon="fas fa-tags">
        <a href="{{ route('lineas.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('lineas.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
