@extends('layouts.app')

@section('title', 'Detalle de auditoría | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de auditoría"
        subtitle="Información registrada de la auditoría."
        icon="fas fa-clipboard-check">
        <a href="{{ route('auditorias.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('auditorias.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
