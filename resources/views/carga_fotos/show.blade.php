@extends('layouts.app')

@section('title', 'Detalle de imagen | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Detalle de imagen"
        subtitle="Información asociada a la carga seleccionada."
        icon="fas fa-image">
        <a class="btn btn-default" href="{{ route('carga_fotos.index') }}">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
        @can('carga_fotos edit')
            <a class="btn btn-primary" href="{{ route('carga_fotos.edit', $foto->fot_cod) }}">
                <i class="fas fa-edit"></i>
                Editar
            </a>
        @endcan
    </x-page-header>

    <div class="content px-3">
        @include('sweetalert::alert')
        @include('carga_fotos.show_fields')
    </div>
@endsection
