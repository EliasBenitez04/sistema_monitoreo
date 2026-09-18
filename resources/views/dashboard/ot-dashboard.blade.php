@extends('layouts.app')

@section('title', 'Dashboard de Órdenes de Trabajo | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Dashboard de Órdenes de Trabajo"
        subtitle="Monitoreo general de producción, procesos, tiempos y atrasos."
        icon="fas fa-chart-line">
        <a href="{{ route('dashboard.ot-atrasadas') }}" class="btn btn-outline-danger">
            <i class="fas fa-exclamation-triangle"></i>
            Ver OT atrasadas
        </a>
    </x-page-header>

    <div class="content px-3 ot-dashboard">
        {{-- =========================================================
             FILTROS
        ========================================================== --}}

    <div class="filter-card">

        <div class="filter-title">

            <i class="fas fa-sliders-h mr-2"></i>

            Filtros de consulta

        </div>


        <form
            method="GET"
            action="{{ route('dashboard.ot') }}">

            <div class="row align-items-end">


                {{-- FECHA DESDE --}}

                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">

                    <label class="filter-label">
                        Fecha desde
                    </label>

                    <input
                        type="date"
                        name="fecha_desde"
                        class="form-control"
                        value="{{ request('fecha_desde') }}">

                </div>


                {{-- FECHA HASTA --}}

                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">

                    <label class="filter-label">
                        Fecha hasta
                    </label>

                    <input
                        type="date"
                        name="fecha_hasta"
                        class="form-control"
                        value="{{ request('fecha_hasta') }}">

                </div>


                {{-- PROCESO --}}

                <div class="col-lg-4 col-md-8 mb-3 mb-lg-0">

                    <label class="filter-label">
                        Proceso
                    </label>

                    <select
                        name="proceso"
                        class="form-control">

                        <option value="">
                            Todos los procesos
                        </option>

                        @foreach($procesosDisponibles as $proceso)

                        <option
                            value="{{ $proceso }}"
                            {{ request('proceso') === $proceso ? 'selected' : '' }}>

                            {{ $proceso }}

                        </option>

                        @endforeach

                    </select>

                </div>


                {{-- BOTONES --}}

                <div class="col-lg-2 col-md-4">

                    <div class="d-flex">

                        <button
                            type="submit"
                            class="btn btn-primary btn-filter btn-block mr-2">

                            <i class="fas fa-filter mr-1"></i>

                            Filtrar

                        </button>


                        @if(request()->hasAny([
                        'fecha_desde',
                        'fecha_hasta',
                        'proceso'
                        ]))

                        <a
                            href="{{ route('dashboard.ot') }}"
                            class="btn btn-clear-filter">

                            <i class="fas fa-times"></i>

                        </a>

                        @endif

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
         KPIs PRINCIPALES
    ========================================================== --}}

    <div class="row mb-1">


        {{-- TOTAL --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-blue">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Total OT
                        </div>

                        <div class="kpi-value">
                            {{ number_format($totalOT, 0, ',', '.') }}
                        </div>

                        <div class="kpi-description">
                            Órdenes registradas
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- EN PROCESO --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-cyan">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            En proceso
                        </div>

                        <div class="kpi-value">
                            {{ number_format($otEnProceso, 0, ',', '.') }}
                        </div>

                        <div class="kpi-description">
                            OT actualmente activas
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-cogs"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- FINALIZADAS --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-green">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Finalizadas
                        </div>

                        <div class="kpi-value">
                            {{ number_format($otFinalizadas, 0, ',', '.') }}
                        </div>

                        <div class="kpi-description">
                            OT completadas
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- ATRASADAS --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-red">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            OT atrasadas
                        </div>

                        <div class="kpi-value">
                            {{ number_format($otAtrasadas, 0, ',', '.') }}
                        </div>

                        <div class="kpi-description">

                            Más de {{ $diasAlerta }} días sin movimiento

                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         KPIs PRODUCCIÓN
    ========================================================== --}}

    <div class="row">


        {{-- ORDENADO --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-dark">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Cantidad ordenada
                        </div>

                        <div class="kpi-value">
                            {{ number_format($cantidadOrdenada, 0, ',', '.') }}
                        </div>

                        <div class="kpi-description">
                            Unidades solicitadas
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-boxes"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- PRODUCIDO --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-green">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Cantidad producida
                        </div>

                        <div class="kpi-value">
                            {{ number_format($cantidadProducida, 0, ',', '.') }}
                        </div>

                        <div class="kpi-description">
                            Unidades producidas
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-industry"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- CUMPLIMIENTO --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-yellow">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Cumplimiento
                        </div>

                        <div class="kpi-value">

                            {{ number_format($cumplimientoGeneral, 2, ',', '.') }}%

                        </div>

                        <div class="kpi-description">
                            Producido / ordenado
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-percentage"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- PROMEDIO --}}

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="kpi-card kpi-purple">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Promedio de días
                        </div>

                        <div class="kpi-value">

                            {{ number_format($promedioDias, 2, ',', '.') }}

                        </div>

                        <div class="kpi-description">
                            Inicio → último movimiento
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="fas fa-stopwatch"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         GRÁFICOS
    ========================================================== --}}

    <div class="row">


        {{-- OT POR PROCESO --}}

        <div class="col-lg-6 mb-4">

            <div class="section-card h-100">

                <div class="section-header">

                    <div class="section-title-wrapper">

                        <div class="section-icon section-icon-blue">

                            <i class="fas fa-project-diagram"></i>

                        </div>

                        <div>

                            <div class="section-title">
                                OT por proceso
                            </div>

                            <div class="section-subtitle">
                                Distribución actual de las órdenes
                            </div>

                        </div>

                    </div>

                </div>


                <div class="section-body">

                    <div class="chart-container">

                        <canvas id="graficoProcesos"></canvas>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRODUCCIÓN --}}

        <div class="col-lg-6 mb-4">

            <div class="section-card h-100">

                <div class="section-header">

                    <div class="section-title-wrapper">

                        <div class="section-icon section-icon-green">

                            <i class="fas fa-chart-area"></i>

                        </div>

                        <div>

                            <div class="section-title">
                                Producción diaria
                            </div>

                            <div class="section-subtitle">
                                Evolución de unidades producidas
                            </div>

                        </div>

                    </div>

                </div>


                <div class="section-body">

                    <div class="chart-container">

                        <canvas id="graficoProduccion"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         TIEMPO POR PROCESO
    ========================================================== --}}

    <div class="section-card mb-4">

        <div class="section-header">

            <div class="section-title-wrapper">

                <div class="section-icon section-icon-yellow">

                    <i class="fas fa-stopwatch"></i>

                </div>

                <div>

                    <div class="section-title">
                        Tiempo promedio por proceso
                    </div>

                    <div class="section-subtitle">
                        Identificación de los procesos que generan mayor demora
                    </div>

                </div>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table dashboard-table">

                <thead>

                    <tr>

                        <th>Proceso</th>

                        <th>OT</th>

                        <th>Promedio</th>

                        <th>Nivel</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($tiempoPorProceso as $item)

                    @php

                    $dias = (float) $item['promedio_dias'];

                    if ($dias >= 30) {
                    $nivel = 'CRÍTICO';
                    $badge = 'badge-danger-modern';
                    $icon = 'fa-fire';
                    } elseif ($dias >= 15) {
                    $nivel = 'ALERTA';
                    $badge = 'badge-warning-modern';
                    $icon = 'fa-exclamation-triangle';
                    } elseif ($dias >= 7) {
                    $nivel = 'ATENCIÓN';
                    $badge = 'badge-info-modern';
                    $icon = 'fa-clock';
                    } else {
                    $nivel = 'NORMAL';
                    $badge = 'badge-success-modern';
                    $icon = 'fa-check';
                    }

                    @endphp

                    <tr>

                        <td>

                            <strong class="product-description">

                                {{ $item['proceso'] }}

                            </strong>

                        </td>

                        <td>

                            <strong>

                                {{ number_format($item['cantidad'], 0, ',', '.') }}

                            </strong>

                        </td>

                        <td>

                            <span class="status-badge {{ $badge }}">

                                <i class="fas {{ $icon }} mr-1"></i>

                                {{ number_format($dias, 2, ',', '.') }}

                                días

                            </span>

                        </td>

                        <td>

                            <span class="status-badge {{ $badge }}">

                                {{ $nivel }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4">

                            <div class="empty-state">

                                <i class="fas fa-database"></i>

                                No existen datos disponibles.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
         DISTRIBUCIÓN POR PROCESO
    ========================================================== --}}

    <div class="section-card mb-4">

        <div class="section-header">

            <div class="section-title-wrapper">

                <div class="section-icon section-icon-blue">

                    <i class="fas fa-layer-group"></i>

                </div>

                <div>

                    <div class="section-title">
                        Distribución de OT por proceso
                    </div>

                    <div class="section-subtitle">
                        Cantidad, participación y nivel de concentración
                    </div>

                </div>

            </div>

        </div>


        <div class="section-body">

            <div class="row">

                @foreach($detalleProcesos as $detalle)

                @php

                $porcentaje = (float) $detalle['porcentaje'];

                $diasProceso = isset($detalle['promedio_dias'])
                ? (float) $detalle['promedio_dias']
                : 0;

                if ($diasProceso >= 30) {
                $processClass = 'process-danger';
                } elseif ($diasProceso >= 15) {
                $processClass = 'process-warning';
                } else {
                $processClass = 'process-normal';
                }

                @endphp


                <div class="col-xl-3 col-lg-4 col-md-6 mb-3">

                    <div class="process-card {{ $processClass }}">

                        <div class="d-flex justify-content-between">

                            <div style="min-width:0;">

                                <div class="process-name">

                                    {{ $detalle['proceso'] }}

                                </div>

                                <div class="process-count">

                                    {{ number_format($detalle['cantidad'], 0, ',', '.') }}

                                </div>

                            </div>


                            <div class="process-icon">

                                <i class="fas fa-cogs"></i>

                            </div>

                        </div>


                        <div class="mt-3">

                            <div class="process-meta mb-1">

                                <span>
                                    Participación
                                </span>

                                <span class="process-percentage">

                                    {{ number_format($porcentaje, 1, ',', '.') }}%

                                </span>

                            </div>


                            <div class="modern-progress">

                                <div
                                    class="progress-bar bg-primary"
                                    style="width: {{ min($porcentaje, 100) }}%;">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>


    {{-- =========================================================
         OT MÁS ATRASADAS
    ========================================================== --}}

    <div class="section-card mb-4">

        <div class="section-header">

            <div class="section-title-wrapper">

                <div class="section-icon section-icon-red">

                    <i class="fas fa-exclamation-circle"></i>

                </div>

                <div>

                    <div class="section-title">
                        OT más atrasadas
                    </div>

                    <div class="section-subtitle">
                        Top 20 órdenes con mayor tiempo sin movimiento
                    </div>

                </div>

            </div>


            <span class="status-badge badge-danger-modern">

                <i class="fas fa-exclamation-triangle mr-1"></i>

                {{ number_format($otAtrasadas, 0, ',', '.') }}

                atrasadas

            </span>

        </div>


        <div class="table-responsive">

            <table class="table dashboard-table">

                <thead>

                    <tr>

                        <th>OT</th>

                        <th>Código</th>

                        <th>Descripción</th>

                        <th>Proceso</th>

                        <th>Ordenado</th>

                        <th>Producido</th>

                        <th>Avance</th>

                        <th>Días</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($rankingAtrasadas as $item)

                    @php

                    $diasAtraso =
                    (float) $item['dias_sin_movimiento'];

                    if ($diasAtraso >= 30) {

                    $rowClass = 'alert-critical';

                    $badgeDias = 'badge-danger-modern';

                    } else {

                    $rowClass = 'alert-warning';

                    $badgeDias = 'badge-warning-modern';

                    }

                    $cumplimiento =
                    (float) $item['cumplimiento'];

                    @endphp


                    <tr class="alert-row {{ $rowClass }}">


                        {{-- OT --}}

                        <td>

                            <span class="ot-number">

                                #{{ $item['ot']->nro_ot }}

                            </span>

                        </td>


                        {{-- CODIGO --}}

                        <td>

                            <code>

                                {{ $item['ot']->codigo }}

                            </code>

                        </td>


                        {{-- DESCRIPCIÓN --}}

                        <td class="product-description-cell">

                            <span class="product-description">

                                {{ $item['ot']->descripcion }}

                            </span>

                        </td>


                        {{-- PROCESO --}}

                        <td>

                            <span class="status-badge badge-process">

                                {{ $item['ultimo_proceso'] }}

                            </span>

                        </td>


                        {{-- ORDENADO --}}

                        <td>

                            <strong>

                                {{ number_format(
                                        $item['cantidad_ordenada'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                            </strong>

                        </td>


                        {{-- PRODUCIDO --}}

                        <td>

                            <strong>

                                {{ number_format(
                                        $item['cantidad_producida'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                            </strong>

                        </td>


                        {{-- AVANCE --}}

                        <td>

                            <div class="progress-wrapper">

                                <div class="progress-label">

                                    <span class="text-muted">
                                        Avance
                                    </span>

                                    <strong>

                                        {{ number_format(
                                                $cumplimiento,
                                                1,
                                                ',',
                                                '.'
                                            ) }}%

                                    </strong>

                                </div>


                                <div class="modern-progress">

                                    <div
                                        class="progress-bar
                                            {{ $cumplimiento >= 100
                                                ? 'bg-success'
                                                : ($cumplimiento >= 50
                                                    ? 'bg-info'
                                                    : 'bg-warning') }}"
                                        style="
                                                width:
                                                {{ min(
                                                    $cumplimiento,
                                                    100
                                                ) }}%;
                                            ">

                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- DÍAS --}}

                        <td>

                            <span
                                class="status-badge {{ $badgeDias }}">

                                <i class="fas fa-clock mr-1"></i>

                                {{ number_format(
                                        $diasAtraso,
                                        1,
                                        ',',
                                        '.'
                                    ) }}

                                días

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8">

                            <div class="empty-state">

                                <i class="fas fa-check-circle text-success"></i>

                                No existen OT atrasadas.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
         ANÁLISIS POR DESCRIPCIÓN
    ========================================================== --}}

    <div class="section-card mb-4">

        <div class="section-header">

            <div class="section-title-wrapper">

                <div class="section-icon section-icon-blue">

                    <i class="fas fa-boxes"></i>

                </div>

                <div>

                    <div class="section-title">
                        Análisis por descripción
                    </div>

                    <div class="section-subtitle">
                        Productos con mayor cantidad de OT, volumen y atraso
                    </div>

                </div>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table dashboard-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Descripción</th>

                        <th>OT</th>

                        <th>Ordenado</th>

                        <th>Producido</th>

                        <th>Cumplimiento</th>

                        <th>Promedio atraso</th>

                        <th>Mayor atraso</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($porDescripcion->take(30) as $index => $item)

                    @php

                    $cumplimiento =
                    (float) $item['cumplimiento'];

                    if ($index === 0) {

                    $rankClass = 'top-1';

                    } elseif ($index === 1) {

                    $rankClass = 'top-2';

                    } elseif ($index === 2) {

                    $rankClass = 'top-3';

                    } else {

                    $rankClass = '';

                    }

                    if ($cumplimiento >= 100) {

                    $cumplimientoClass =
                    'badge-success-modern';

                    } elseif ($cumplimiento >= 80) {

                    $cumplimientoClass =
                    'badge-warning-modern';

                    } else {

                    $cumplimientoClass =
                    'badge-danger-modern';

                    }

                    @endphp


                    <tr>


                        {{-- RANK --}}

                        <td>

                            <span class="rank-number {{ $rankClass }}">

                                {{ $index + 1 }}

                            </span>

                        </td>


                        {{-- DESCRIPCIÓN --}}

                        <td class="product-description-cell">

                            <span class="product-description">

                                {{ $item['descripcion'] }}

                            </span>

                        </td>


                        {{-- OT --}}

                        <td>

                            <strong>

                                {{ number_format(
                                        $item['cantidad_ot'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                            </strong>

                        </td>


                        {{-- ORDENADO --}}

                        <td>

                            {{ number_format(
                                    $item['cantidad_ordenada'],
                                    0,
                                    ',',
                                    '.'
                                ) }}

                        </td>


                        {{-- PRODUCIDO --}}

                        <td>

                            {{ number_format(
                                    $item['cantidad_producida'],
                                    0,
                                    ',',
                                    '.'
                                ) }}

                        </td>


                        {{-- CUMPLIMIENTO --}}

                        <td>

                            <span
                                class="status-badge
                                    {{ $cumplimientoClass }}">

                                {{ number_format(
                                        $cumplimiento,
                                        1,
                                        ',',
                                        '.'
                                    ) }}%

                            </span>

                        </td>


                        {{-- PROMEDIO --}}

                        <td>

                            {{ number_format(
                                    $item['promedio_atraso'],
                                    1,
                                    ',',
                                    '.'
                                ) }}

                            días

                        </td>


                        {{-- MAYOR --}}

                        <td>

                            <span class="font-weight-bold">

                                {{ number_format(
                                        $item['mayor_atraso'],
                                        1,
                                        ',',
                                        '.'
                                    ) }}

                                días

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8">

                            <div class="empty-state">

                                <i class="fas fa-box-open"></i>

                                No existen datos por descripción.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
         RESUMEN EJECUTIVO
    ========================================================== --}}

    <div class="row mb-4">


        {{-- MAYOR ATRASO --}}

        <div class="col-md-4 mb-3">

            <div class="summary-card summary-danger">

                <div class="summary-title">

                    <i class="fas fa-fire mr-1"></i>

                    Mayor atraso

                </div>

                <div class="summary-value">

                    {{ number_format(
                        $mayorAtraso,
                        2,
                        ',',
                        '.'
                    ) }}

                    <small>días</small>

                </div>

            </div>

        </div>


        {{-- PROMEDIO ATRASO --}}

        <div class="col-md-4 mb-3">

            <div class="summary-card summary-warning">

                <div class="summary-title">

                    <i class="fas fa-clock mr-1"></i>

                    Promedio atraso

                </div>

                <div class="summary-value">

                    {{ number_format(
                        $promedioAtraso,
                        2,
                        ',',
                        '.'
                    ) }}

                    <small>días</small>

                </div>

            </div>

        </div>


        {{-- CUMPLIMIENTO --}}

        <div class="col-md-4 mb-3">

            <div class="summary-card summary-primary">

                <div class="summary-title">

                    <i class="fas fa-chart-line mr-1"></i>

                    Cumplimiento general

                </div>

                <div class="summary-value">

                    {{ number_format(
                        $cumplimientoGeneral,
                        2,
                        ',',
                        '.'
                    ) }}%

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     CHART.JS
========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {


        /* =========================================================
           DATOS
        ========================================================= */

        const procesosLabels = @json(
            $otsPorProceso -> keys() -> values()
        );

        const procesosData = @json(
            $otsPorProceso -> values()
        );


        const produccionLabels = @json(
            $produccionDiariaFinal -> keys() -> values()
        );

        const produccionData = @json(
            $produccionDiariaFinal -> values()
        );


        /* =========================================================
           PLUGIN PARA MOSTRAR VALORES
        ========================================================= */

        const mostrarValores = {

            id: 'mostrarValores',

            afterDatasetsDraw(chart) {

                const {
                    ctx
                } = chart;

                chart.data.datasets.forEach(
                    (dataset, datasetIndex) => {

                        const meta =
                            chart.getDatasetMeta(datasetIndex);

                        meta.data.forEach(
                            (element, index) => {

                                const value =
                                    dataset.data[index];

                                if (
                                    value === null ||
                                    value === undefined
                                ) {
                                    return;
                                }

                                ctx.save();

                                ctx.font =
                                    '700 10px Arial';

                                ctx.fillStyle =
                                    '#475569';

                                ctx.textAlign =
                                    'center';

                                ctx.textBaseline =
                                    'bottom';

                                ctx.fillText(
                                    Number(value).toLocaleString(
                                        'es-PY'
                                    ),
                                    element.x,
                                    element.y - 7
                                );

                                ctx.restore();

                            }
                        );

                    }
                );

            }

        };


        /* =========================================================
           GRÁFICO OT POR PROCESO
        ========================================================= */

        const canvasProcesos =
            document.getElementById(
                'graficoProcesos'
            );


        if (canvasProcesos) {

            new Chart(
                canvasProcesos, {

                    type: 'bar',

                    plugins: [
                        mostrarValores
                    ],

                    data: {

                        labels: procesosLabels,

                        datasets: [

                            {

                                label: 'Cantidad de OT',

                                data: procesosData,

                                borderRadius: 7,

                                borderSkipped: false,

                                maxBarThickness: 48,

                                backgroundColor: 'rgba(37,99,235,.78)',

                                hoverBackgroundColor: '#2563eb'

                            }

                        ]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        layout: {

                            padding: {

                                top: 25

                            }

                        },

                        interaction: {

                            intersect: false,

                            mode: 'index'

                        },

                        plugins: {

                            legend: {

                                display: false

                            },

                            tooltip: {

                                backgroundColor: '#172033',

                                titleFont: {

                                    size: 12

                                },

                                bodyFont: {

                                    size: 12

                                },

                                padding: 12,

                                cornerRadius: 8,

                                displayColors: false,

                                callbacks: {

                                    label: function(context) {

                                        return (
                                            ' OT: ' +
                                            Number(
                                                context.raw
                                            ).toLocaleString(
                                                'es-PY'
                                            )
                                        );

                                    }

                                }

                            }

                        },

                        scales: {

                            x: {

                                grid: {

                                    display: false

                                },

                                ticks: {

                                    font: {

                                        size: 9

                                    },

                                    color: '#7b8497',

                                    maxRotation: 35,

                                    minRotation: 0

                                }

                            },

                            y: {

                                beginAtZero: true,

                                grid: {

                                    color: '#edf0f5'

                                },

                                ticks: {

                                    precision: 0,

                                    color: '#7b8497'

                                }

                            }

                        }

                    }

                }
            );

        }


        /* =========================================================
           GRÁFICO PRODUCCIÓN DIARIA
        ========================================================= */

        const canvasProduccion =
            document.getElementById(
                'graficoProduccion'
            );


        if (canvasProduccion) {

            new Chart(
                canvasProduccion, {

                    type: 'line',

                    data: {

                        labels: produccionLabels,

                        datasets: [

                            {

                                label: 'Unidades producidas',

                                data: produccionData,

                                fill: true,

                                tension: .35,

                                borderWidth: 3,

                                pointRadius: 3,

                                pointHoverRadius: 6,

                                borderColor: '#16a34a',

                                backgroundColor: 'rgba(22,163,74,.10)',

                                pointBackgroundColor: '#16a34a',

                                pointBorderColor: '#ffffff',

                                pointBorderWidth: 2

                            }

                        ]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        interaction: {

                            intersect: false,

                            mode: 'index'

                        },

                        plugins: {

                            legend: {

                                position: 'top',

                                align: 'end',

                                labels: {

                                    boxWidth: 10,

                                    usePointStyle: true,

                                    font: {

                                        size: 10

                                    }

                                }

                            },

                            tooltip: {

                                backgroundColor: '#172033',

                                padding: 12,

                                cornerRadius: 8,

                                displayColors: false,

                                callbacks: {

                                    label: function(context) {

                                        return (
                                            ' Producción: ' +
                                            Number(
                                                context.raw
                                            ).toLocaleString(
                                                'es-PY'
                                            ) +
                                            ' unidades'
                                        );

                                    }

                                }

                            }

                        },

                        scales: {

                            x: {

                                grid: {

                                    display: false

                                },

                                ticks: {

                                    color: '#7b8497',

                                    font: {

                                        size: 9

                                    },

                                    maxRotation: 35

                                }

                            },

                            y: {

                                beginAtZero: true,

                                grid: {

                                    color: '#edf0f5'

                                },

                                ticks: {

                                    color: '#7b8497',

                                    callback: function(value) {

                                        return Number(
                                            value
                                        ).toLocaleString(
                                            'es-PY'
                                        );

                                    }

                                }

                            }

                        }

                    }

                }
            );

        }

    });
</script>

@endsection

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/dashboard-ot.css') }}?v=20260918-2">
@endpush
