@extends('layouts.app')

@section('title', 'Detalle del permiso | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle del permiso"
        subtitle="Información registrada del permiso."
        icon="fas fa-key">
        <a href="{{ route('permissions.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('permissions.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection

