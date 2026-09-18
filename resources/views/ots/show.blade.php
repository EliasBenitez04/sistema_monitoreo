@extends('layouts.app')

@section('title', 'Detalle de orden de trabajo | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de orden de trabajo"
        subtitle="Información registrada de la orden de trabajo."
        icon="fas fa-clipboard-check">
        <a href="{{ route('ots.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('ots.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
