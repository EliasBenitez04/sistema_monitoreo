@extends('layouts.app')

@section('title', 'Importación de stock | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Importación de stock"
        subtitle="Carga y control de información de existencias para los procesos de monitoreo."
        icon="fas fa-boxes" />

    <div class="content px-3">
        @include('stocks.table')
    </div>
@endsection
