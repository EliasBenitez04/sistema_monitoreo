@extends('layouts.app')

@section('content')
    <div class="redistribucion-proceso-page">

        <div class="container-fluid">

            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <div class="process-header mb-4">

                <div class="header-left">

                    <div class="header-icon">
                        <i class="fas fa-random"></i>
                    </div>

                    <div>
                        <span class="header-overline">
                            REDISTRIBUCIÓN
                        </span>

                        <h3>
                            Proceso #{{ $proceso->id }}
                        </h3>

                        <p>
                            Gestión y preparación de transferencias masivas
                        </p>
                    </div>

                </div>

                <div class="header-right">

                    <span class="process-status">
                        <span class="status-dot"></span>
                        APROBADO
                    </span>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- RESUMEN --}}
            {{-- ===================================================== --}}

            <div class="row mb-4">

                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="summary-card">

                        <div class="summary-icon blue">
                            <i class="fas fa-box"></i>
                        </div>

                        <div>

                            <span class="summary-label">
                                PRODUCTOS
                            </span>

                            <strong>
                                {{ number_format($proceso->total_productos) }}
                            </strong>

                            <small>
                                Productos involucrados
                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="summary-card">

                        <div class="summary-icon purple">
                            <i class="fas fa-exchange-alt"></i>
                        </div>

                        <div>

                            <span class="summary-label">
                                TRANSFERENCIAS
                            </span>

                            <strong>
                                {{ number_format($proceso->total_movimientos) }}
                            </strong>

                            <small>
                                Movimientos aprobados
                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="summary-card">

                        <div class="summary-icon orange">
                            <i class="fas fa-cubes"></i>
                        </div>

                        <div>

                            <span class="summary-label">
                                UNIDADES
                            </span>

                            <strong>
                                {{ number_format($proceso->detalles->sum('cantidad')) }}
                            </strong>

                            <small>
                                Unidades a transferir
                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="summary-card">

                        <div class="summary-icon green">
                            <i class="fas fa-user"></i>
                        </div>

                        <div>

                            <span class="summary-label">
                                USUARIO
                            </span>

                            <strong class="user-value">
                                {{ $proceso->usuario ?? 'SISTEMA' }}
                            </strong>

                            <small>
                                Responsable del proceso
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- INFORMACIÓN DEL PROCESO --}}
            {{-- ===================================================== --}}

            <div class="card enterprise-card mb-4">

                <div class="card-header enterprise-card-header">

                    <div>

                        <h5>
                            <i class="fas fa-info-circle"></i>
                            Información del proceso
                        </h5>

                        <small>
                            Datos generales de la redistribución aprobada
                        </small>

                    </div>

                    <span class="approved-badge">
                        <i class="fas fa-check-circle"></i>
                        APROBADO
                    </span>

                </div>


                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="info-item">

                                <span>
                                    PROCESO
                                </span>

                                <strong>
                                    #{{ $proceso->id }}
                                </strong>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="info-item">

                                <span>
                                    FECHA
                                </span>

                                <strong>
                                    {{ optional($proceso->fecha)->format('d/m/Y H:i') }}
                                </strong>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="info-item">

                                <span>
                                    USUARIO
                                </span>

                                <strong>
                                    {{ $proceso->usuario ?? 'SISTEMA' }}
                                </strong>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="info-item">

                                <span>
                                    ESTADO
                                </span>

                                <strong class="text-success">
                                    APROBADO
                                </strong>

                            </div>

                        </div>

                    </div>


                    @if ($proceso->observacion)
                        <div class="process-observation mt-4">

                            <i class="fas fa-comment-alt"></i>

                            <div>

                                <strong>
                                    Observación
                                </strong>

                                <p>
                                    {{ $proceso->observacion }}
                                </p>

                            </div>

                        </div>
                    @endif

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- TRANSFERENCIAS --}}
            {{-- ===================================================== --}}

            <div class="card enterprise-card">

                <div class="card-header enterprise-card-header">

                    <div>

                        <h5>
                            <i class="fas fa-list"></i>
                            Transferencias del proceso
                        </h5>

                        <small>
                            {{ $proceso->detalles->count() }}
                            movimientos incluidos en este proceso
                        </small>

                    </div>

                    <span class="movement-counter">
                        {{ number_format($proceso->detalles->count()) }}
                        movimientos
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table enterprise-table">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>
                                    PRODUCTO
                                </th>

                                <th>
                                    ORIGEN
                                </th>

                                <th>
                                    DESTINO
                                </th>

                                <th class="text-center">
                                    CANTIDAD
                                </th>

                                <th class="text-center">
                                    ESTADO
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($proceso->detalles as $detalle)
                                <tr>

                                    <td class="row-number">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>

                                        <div class="product-info">

                                            <div class="product-mini-icon">
                                                <i class="fas fa-barcode"></i>
                                            </div>

                                            <div>

                                                <strong>
                                                    {{ $detalle->codigo }}
                                                </strong>

                                                <small>
                                                    Código de producto
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <div class="branch-cell">

                                            <span class="branch-origin">
                                                <i class="fas fa-arrow-up"></i>
                                            </span>

                                            <div>

                                                <strong>
                                                    {{ optional($detalle->origen)->suc_descri ?? $detalle->sucursal_origen }}
                                                </strong>

                                                <small>
                                                    ORIGEN
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <div class="branch-cell">

                                            <span class="branch-destination">
                                                <i class="fas fa-arrow-down"></i>
                                            </span>

                                            <div>

                                                <strong>
                                                    {{ optional($detalle->destino)->suc_descri ?? $detalle->sucursal_destino }}
                                                </strong>

                                                <small>
                                                    DESTINO
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    <td class="text-center">

                                        <span class="quantity">
                                            {{ number_format($detalle->cantidad) }}
                                        </span>

                                    </td>


                                    <td class="text-center">

                                        @if ($detalle->lote_id)
                                            <span class="detail-status generated">
                                                <span></span>
                                                EN LOTE
                                            </span>
                                        @else
                                            <span class="detail-status pending">
                                                <span></span>
                                                PENDIENTE
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6">

                                        <div class="empty-process">

                                            <i class="fas fa-inbox"></i>

                                            <h5>
                                                No existen transferencias
                                            </h5>

                                            <p>
                                                Este proceso no contiene movimientos.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ================================================= --}}
                {{-- FOOTER ACCIONES --}}
                {{-- ================================================= --}}

                <div class="process-actions">

                    <a href="{{ route('RedistribucionSugeridas.index') }}" class="btn btn-light enterprise-btn">

                        <i class="fas fa-arrow-left"></i>

                        Volver

                    </a>


                    @php
                        $pendientes = $proceso->detalles->whereNull('lote_id')->where('estado', 'PENDIENTE')->count();
                    @endphp

                    @if ($pendientes > 0)
                        <form action="{{ route('RedistribucionSugeridas.generarLote', ['procesoId' => $proceso->id]) }}"
                            method="POST" style="display:inline;">

                            @csrf

                            <button type="submit" class="btn btn-sm btn-primary">

                                <i class="fas fa-layer-group"></i>

                                Generar lote

                            </button>

                        </form>
                    @else
                        <span class="already-generated">

                            <i class="fas fa-check-circle"></i>

                            Todos los movimientos ya tienen lote

                        </span>
                    @endif
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CSS --}}
    {{-- ========================================================= --}}

    
@endsection

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/redistribucion-proceso.css') }}?v=20260918-2">
@endpush
