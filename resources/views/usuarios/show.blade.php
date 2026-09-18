@extends('layouts.app')

@section('title', 'Detalle del usuario | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle del usuario"
        subtitle="Información registrada del usuario."
        icon="fas fa-users">
        <a href="{{ route('usuarios.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('usuarios.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection

