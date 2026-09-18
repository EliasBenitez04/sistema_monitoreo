@extends('layouts.app')

@section('title', 'Detalle del rol | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle del rol"
        subtitle="Información registrada del rol."
        icon="fas fa-user-shield">
        <a href="{{ route('roles.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="card sm-detail-card">
            <div class="card-body">
                <div class="row">
                    @include('roles.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
