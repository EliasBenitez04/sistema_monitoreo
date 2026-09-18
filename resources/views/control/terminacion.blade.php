@extends('layouts.app')

@section('title', 'Control de terminación | ' . config('app.name'))

@section('content')
    

    <div class="container-fluid control-container">
        {{-- =====================================================
     ENCABEZADO
====================================================== --}}
        <div class="mb-3">
            <h2 class="page-title">
                <i class="fas fa-industry mr-1"></i>
                Control de Producto Terminado
            </h2>

            <div class="page-subtitle">
                Seguimiento desde Terminación hasta el envío a locales
            </div>
        </div>


        {{-- =====================================================
     FILTROS PRINCIPALES
====================================================== --}}
        <div class="card shadow-sm mb-4 filtros-card">
            <div class="card-body">

                <form method="GET" action="{{ route('control.terminacion') }}" class="row align-items-end">

                    {{-- FECHAS --}}
                    <div class="col-md-4">
                        <label class="form-label filtro-label">
                            Fecha de Producto Terminado
                        </label>

                        <div class="row">

                            <div class="col-md-6">
                                <label class="form-label filtro-label">
                                    Desde
                                </label>

                                <input type="date" name="fecha_desde" id="fecha_desde" class="form-control filtro-input"
                                    value="{{ $fechaDesde }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label filtro-label">
                                    Hasta
                                </label>

                                <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control filtro-input"
                                    value="{{ $fechaHasta }}" required>
                            </div>

                        </div>
                    </div>


                    {{-- ESTADOS --}}
                    <div class="col-md-5 mt-3 mt-md-0">

                        <label class="form-label filtro-label">
                            Estado
                        </label>

                        <div class="estado-filtros">

                            {{-- NO ENVIADO --}}
                            <div class="estado-option">

                                <input type="checkbox" name="estado[]" value="NO ENVIADO" id="estado_no_enviado"
                                    {{ in_array('NO ENVIADO', request()->get('estado', [])) ? 'checked' : '' }}>

                                <label for="estado_no_enviado" class="estado-label">
                                    <i class="fas fa-times-circle estado-icon text-danger"></i>

                                    <span class="estado-texto">
                                        No enviado
                                    </span>

                                    <i class="fas fa-check estado-check"></i>
                                </label>

                            </div>


                            {{-- PARCIAL --}}
                            <div class="estado-option">

                                <input type="checkbox" name="estado[]" value="PARCIAL" id="estado_parcial"
                                    {{ in_array('PARCIAL', request()->get('estado', [])) ? 'checked' : '' }}>

                                <label for="estado_parcial" class="estado-label">
                                    <i class="fas fa-adjust estado-icon text-warning"></i>

                                    <span class="estado-texto">
                                        Parcial
                                    </span>

                                    <i class="fas fa-check estado-check"></i>
                                </label>

                            </div>


                            {{-- FINALIZADO --}}
                            <div class="estado-option">

                                <input type="checkbox" name="estado[]" value="FINALIZADO" id="estado_finalizado"
                                    {{ in_array('FINALIZADO', request()->get('estado', [])) ? 'checked' : '' }}>

                                <label for="estado_finalizado" class="estado-label">
                                    <i class="fas fa-check-circle estado-icon text-success"></i>

                                    <span class="estado-texto">
                                        Finalizado
                                    </span>

                                    <i class="fas fa-check estado-check"></i>
                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- BOTONES --}}
                    <div class="col-md-3 mt-3 mt-md-0">

                        <div class="d-flex gap-2">

                            <button type="submit" class="btn btn-primary btn-consultar flex-grow-1">
                                <i class="fas fa-search me-1"></i>
                                Consultar
                            </button>

                            <a href="{{ route('control.terminacion') }}" class="btn btn-outline-secondary btn-limpiar"
                                title="Limpiar filtros">
                                <i class="fas fa-eraser"></i>
                            </a>

                        </div>

                    </div>

                </form>

            </div>
        </div>


        {{-- =====================================================
     INDICADORES
====================================================== --}}
        <div class="row g-3 mb-4">

            {{-- PRODUCTO TERMINADO --}}
            <div class="col-xl-3 col-md-6">

                <div class="card indicador-card border-left-primary shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>
                                <div class="indicador-titulo">
                                    Producto Terminado
                                </div>

                                <div class="indicador-valor">
                                    {{ number_format($totalTerminado, 0, ',', '.') }}
                                </div>

                                <div class="indicador-extra">
                                    {{ number_format($totalOTs, 0, ',', '.') }} OTs
                                </div>
                            </div>

                            <div class="indicador-icono">
                                <i class="fas fa-box"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ENVIADO --}}
            <div class="col-xl-3 col-md-6">

                <div class="card indicador-card border-left-success shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>
                                <div class="indicador-titulo">
                                    Enviado a Locales
                                </div>

                                <div class="indicador-valor">
                                    {{ number_format($totalEnviado, 0, ',', '.') }}
                                </div>

                                <div class="indicador-extra">
                                    {{ number_format($porcentajeEnviado, 1, ',', '.') }}% del total
                                </div>
                            </div>

                            <div class="indicador-icono">
                                <i class="fas fa-truck"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PENDIENTE --}}
            <div class="col-xl-3 col-md-6">

                <div class="card indicador-card border-left-warning shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>
                                <div class="indicador-titulo">
                                    Pendiente de Envío
                                </div>

                                <div class="indicador-valor">
                                    {{ number_format(max(0, $totalDiferencia), 0, ',', '.') }}
                                </div>

                                <div class="indicador-extra">
                                    {{ number_format($otsPendientes, 0, ',', '.') }} OTs pendientes
                                </div>
                            </div>

                            <div class="indicador-icono">
                                <i class="fas fa-clock"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- OTS COMPLETAS --}}
            <div class="col-xl-3 col-md-6">

                <div class="card indicador-card border-left-danger shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>
                                <div class="indicador-titulo">
                                    OTs Completas
                                </div>

                                <div class="indicador-valor">
                                    {{ number_format($otsCompletas, 0, ',', '.') }}
                                </div>

                                <div class="indicador-extra">
                                    de {{ number_format($totalOTs, 0, ',', '.') }} OTs
                                </div>
                            </div>

                            <div class="indicador-icono">
                                <i class="fas fa-check-double"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
     ALERTAS
====================================================== --}}

        @if ($otsNoEnviadas > 0)
            <div class="alert alert-danger control-alert d-flex align-items-center mb-4">

                <i class="fas fa-exclamation-triangle me-2"></i>

                <div>
                    <strong>Atención:</strong>
                    Hay {{ $otsNoEnviadas }} OTs terminadas que todavía no tienen envíos registrados.
                </div>

            </div>
        @elseif($totalDiferencia > 0)
            <div class="alert alert-warning control-alert d-flex align-items-center mb-4">

                <i class="fas fa-exclamation-circle me-2"></i>

                <div>
                    <strong>Envíos pendientes:</strong>
                    Hay {{ number_format($totalDiferencia, 0, ',', '.') }} unidades que todavía no fueron enviadas.
                </div>

            </div>
        @elseif($totalTerminado > 0)
            <div class="alert alert-success control-alert d-flex align-items-center mb-4">

                <i class="fas fa-check-circle me-2"></i>

                <div>
                    <strong>Todo en orden:</strong>
                    Toda la producción terminada seleccionada aparece enviada a locales.
                </div>

            </div>
        @endif


        {{-- =====================================================
     TABLA PRINCIPAL
====================================================== --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <strong>
                            <i class="fas fa-list-alt me-1"></i>
                            Seguimiento de Producto Terminado
                        </strong>

                        <div class="text-muted small mt-1">
                            Detalle de producción y estado de envío
                        </div>
                    </div>

                    <span class="badge bg-primary">
                        {{ $totalOTs }} OTs
                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive tabla-responsive">

                    <table class="table tabla-control">

                        <thead>

                            <tr>

                                <th>OT</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th class="text-end">Cantidad</th>
                                <th>Terminado</th>
                                <th>Primera Salida</th>
                                <th>Última Salida</th>
                                <th class="text-end">Enviado</th>
                                <th class="text-end">Diferencia</th>
                                <th class="text-center">Estado</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($produccionTerminada as $item)
                                <tr>

                                    {{-- OT --}}
                                    <td>
                                        <span class="ot-badge">
                                            {{ $item->nro_ot }}
                                        </span>
                                    </td>


                                    {{-- CÓDIGO --}}
                                    <td>
                                        <span class="codigo-texto">
                                            {{ $item->codigo }}
                                        </span>
                                    </td>


                                    {{-- DESCRIPCIÓN --}}
                                    <td>
                                        <div class="descripcion-texto">
                                            {{ $item->descripcion }}
                                        </div>
                                    </td>


                                    {{-- CANTIDAD --}}
                                    <td class="text-end">
                                        <span class="cantidad-texto">
                                            {{ number_format($item->cantidad_terminada, 0, ',', '.') }}
                                        </span>
                                    </td>


                                    {{-- FECHA TERMINADO --}}
                                    <td>
                                        {{ $item->fecha_producto_terminado
                                            ? \Carbon\Carbon::parse($item->fecha_producto_terminado)->format('d/m/Y')
                                            : '—' }}
                                    </td>


                                    {{-- PRIMERA SALIDA --}}
                                    <td>
                                        {{ $item->primera_salida ? \Carbon\Carbon::parse($item->primera_salida)->format('d/m/Y') : '—' }}
                                    </td>


                                    {{-- ÚLTIMA SALIDA --}}
                                    <td>
                                        {{ $item->ultima_salida ? \Carbon\Carbon::parse($item->ultima_salida)->format('d/m/Y') : '—' }}
                                    </td>


                                    {{-- ENVIADO --}}
                                    <td class="text-end">
                                        <span class="cantidad-texto">
                                            {{ number_format($item->cantidad_enviada, 0, ',', '.') }}
                                        </span>
                                    </td>


                                    {{-- DIFERENCIA --}}
                                    <td class="text-end">

                                        @if ($item->diferencia > 0)
                                            <span class="badge bg-danger estado-badge">
                                                {{ number_format($item->diferencia, 0, ',', '.') }}
                                            </span>
                                        @elseif($item->diferencia < 0)
                                            <span class="badge bg-warning text-dark estado-badge">
                                                {{ number_format($item->diferencia, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="badge bg-success estado-badge">
                                                0
                                            </span>
                                        @endif

                                    </td>


                                    {{-- ESTADO --}}
                                    <td class="text-center">

                                        @if ($item->estado_control === 'FINALIZADO')
                                            <span class="badge bg-success estado-badge">
                                                <i class="fas fa-check me-1"></i>
                                                FINALIZADO
                                            </span>
                                        @elseif($item->estado_control === 'NO ENVIADO')
                                            <span class="badge bg-danger estado-badge">
                                                <i class="fas fa-times me-1"></i>
                                                NO ENVIADO
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark estado-badge">
                                                <i class="fas fa-adjust me-1"></i>
                                                PARCIAL
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="10" class="text-center text-muted py-5">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>

                                        No se encontraron registros para los filtros seleccionados.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>


                        {{-- TOTAL --}}
                        <tfoot>

                            <tr>

                                <td colspan="3">
                                    TOTAL
                                </td>

                                <td class="text-end">
                                    {{ number_format($totalTerminado, 0, ',', '.') }}
                                </td>

                                <td colspan="3"></td>

                                <td class="text-end">
                                    {{ number_format($totalEnviado, 0, ',', '.') }}
                                </td>

                                <td class="text-end">
                                    {{ number_format($totalDiferencia, 0, ',', '.') }}
                                </td>

                                <td></td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>


        {{-- =====================================================
     DETALLE DE ENVÍOS A LOCALES
====================================================== --}}
        <div class="card shadow-sm mb-4 border-0">

            <div class="card-header py-3">

                <div class="detalle-header">

                    <div>
                        <div class="detalle-titulo">
                            <i class="fas fa-store me-1"></i>
                            Detalle de Envíos a Locales
                        </div>

                        <div class="detalle-subtitulo">
                            Movimientos registrados para las OTs seleccionadas
                        </div>
                    </div>

                    <span class="badge bg-success">
                        {{ $detalleLogistica->count() }} movimientos
                    </span>

                </div>

            </div>


            <div class="card-body">

                {{-- =================================================
             RESUMEN
        ================================================== --}}

                @php
                    $totalUnidades = $detalleLogistica->sum('cantidad');
                    $totalLocales = $detalleLogistica->pluck('sucursal')->filter()->unique()->count();
                    $totalOTs = $detalleLogistica->pluck('nro_ot')->filter()->unique()->count();
                @endphp


                {{-- =================================================
             TARJETAS RESUMEN
        ================================================== --}}

                <div class="row g-3 mb-4" id="resumenEnvios">

                    {{-- MOVIMIENTOS --}}
                    <div class="col-xl-3 col-md-6">

                        <div class="resumen-card resumen-card-blue">

                            <div class="resumen-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>

                            <div class="resumen-info">

                                <span>
                                    Movimientos
                                </span>

                                <strong id="cardMovimientos">
                                    {{ number_format($detalleLogistica->count(), 0, ',', '.') }}
                                </strong>

                                <small>
                                    registros encontrados
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- UNIDADES --}}
                    <div class="col-xl-3 col-md-6">

                        <div class="resumen-card resumen-card-green">

                            <div class="resumen-icon">
                                <i class="fas fa-boxes"></i>
                            </div>

                            <div class="resumen-info">

                                <span>
                                    Unidades
                                </span>

                                <strong id="cardUnidades">
                                    {{ number_format($totalUnidades, 0, ',', '.') }}
                                </strong>

                                <small>
                                    prendas enviadas
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- LOCALES --}}
                    <div class="col-xl-3 col-md-6">

                        <div class="resumen-card resumen-card-orange">

                            <div class="resumen-icon">
                                <i class="fas fa-store"></i>
                            </div>

                            <div class="resumen-info">

                                <span>
                                    Locales
                                </span>

                                <strong id="cardLocales">
                                    {{ number_format($totalLocales, 0, ',', '.') }}
                                </strong>

                                <small>
                                    destinos involucrados
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- OTS --}}
                    <div class="col-xl-3 col-md-6">

                        <div class="resumen-card resumen-card-purple">

                            <div class="resumen-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>

                            <div class="resumen-info">

                                <span>
                                    OTs
                                </span>

                                <strong id="cardOTs">
                                    {{ number_format($totalOTs, 0, ',', '.') }}
                                </strong>

                                <small>
                                    órdenes encontradas
                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
             FILTROS DE ENVÍOS
        ================================================== --}}

                <div class="filtros-envio mb-3">

                    <div class="row g-2 align-items-center">

                        {{-- BUSCAR --}}
                        <div class="col-lg-5 col-md-6">

                            <div class="input-group">

                                <span class="input-group-text bg-white">
                                    <i class="fas fa-search text-muted"></i>
                                </span>

                                <input type="text" id="buscarEnvio" class="form-control"
                                    placeholder="Buscar OT, código o local...">

                                <button type="button" id="limpiarBusqueda" class="btn btn-outline-secondary"
                                    title="Limpiar búsqueda">

                                    <i class="fas fa-times"></i>

                                </button>

                            </div>

                        </div>


                        {{-- LOCAL --}}
                        <div class="col-lg-4 col-md-6">

                            <select id="filtroLocal" class="form-select select2-local">
                                <option value="">Todos los locales</option>

                                @foreach ($detalleLogistica->pluck('sucursal')->filter()->unique()->sort() as $local)
                                    <option value="{{ strtolower($local) }}">
                                        {{ $local }}
                                    </option>
                                @endforeach
                            </select>

                        </div>


                        {{-- LIMPIAR --}}
                        <div class="col-lg-3 col-md-12">

                            <button type="button" id="limpiarFiltros" class="btn btn-outline-primary btn-filtro w-100">

                                <i class="fas fa-eraser me-1"></i>
                                Limpiar filtros

                            </button>

                        </div>

                    </div>

                </div>


                {{-- =================================================
             RESULTADOS
        ================================================== --}}

                <div class="d-flex justify-content-between align-items-center mb-2">

                    <small class="text-muted">

                        Mostrando

                        <strong id="cantidadResultados">
                            {{ $detalleLogistica->count() }}
                        </strong>

                        movimientos

                    </small>

                </div>


                {{-- =================================================
             TABLA ENVÍOS
        ================================================== --}}

                <div class="table-responsive tabla-responsive">

                    <table class="table tabla-envios" id="tablaEnvios">

                        <thead>

                            <tr>

                                <th style="width: 45px;">
                                    #
                                </th>

                                <th>
                                    OT
                                </th>

                                <th>
                                    Código
                                </th>

                                <th>
                                    Local
                                </th>

                                <th class="text-end">
                                    Cantidad
                                </th>

                                <th>
                                    Fecha de salida
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($detalleLogistica as $index => $item)
                                <tr class="fila-envio" data-local="{{ strtolower($item->sucursal ?? '') }}"
                                    data-ot="{{ $item->nro_ot ?? '' }}"
                                    data-cantidad="{{ (int) ($item->cantidad ?? 0) }}"
                                    data-busqueda="{{ strtolower(($item->nro_ot ?? '') . ' ' . ($item->codigo ?? '') . ' ' . ($item->sucursal ?? '')) }}">

                                    {{-- NÚMERO --}}
                                    <td class="text-muted">
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- OT --}}
                                    <td>

                                        <strong>
                                            {{ $item->nro_ot }}
                                        </strong>

                                    </td>


                                    {{-- CÓDIGO --}}
                                    <td>

                                        <span class="codigo-texto">
                                            {{ $item->codigo }}
                                        </span>

                                    </td>


                                    {{-- LOCAL --}}
                                    <td>

                                        <span class="local-texto">
                                            {{ $item->sucursal }}
                                        </span>

                                    </td>


                                    {{-- CANTIDAD --}}
                                    <td class="text-end">

                                        @if ((int) $item->cantidad >= 100)
                                            <span class="badge bg-success cantidad-envio">
                                                {{ number_format((int) $item->cantidad, 0, ',', '.') }}
                                            </span>
                                        @elseif((int) $item->cantidad >= 50)
                                            <span class="badge bg-warning text-dark cantidad-envio">
                                                {{ number_format((int) $item->cantidad, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary cantidad-envio">
                                                {{ number_format((int) $item->cantidad, 0, ',', '.') }}
                                            </span>
                                        @endif

                                    </td>


                                    {{-- FECHA --}}
                                    <td>

                                        @if ($item->created_at)
                                            <span class="fecha-envio">

                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}

                                                <br>

                                                <small>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                                                </small>

                                            </span>
                                        @else
                                            —
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center text-muted py-5">

                                        <i class="fas fa-truck-loading fa-2x mb-2 d-block"></i>

                                        No existen movimientos de envío para los registros seleccionados.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- SIN RESULTADOS DEL FILTRO --}}

                <div id="sinResultados" class="text-center py-5 d-none sin-resultados">

                    <i class="fas fa-search fa-2x mb-2 d-block"></i>

                    <strong>
                        No se encontraron movimientos
                    </strong>

                    <div class="small mt-1">
                        Prueba con otro texto o selecciona otro local.
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
     CSS TARJETAS
========================================================= --}}
{{-- =========================================================
     JAVASCRIPT
     FILTRO + ACTUALIZACIÓN DE TARJETAS
========================================================= --}}

        
    @endsection

@push('page_scripts')
<script>
            document.addEventListener('DOMContentLoaded', function() {

                const buscador =
                    document.getElementById('buscarEnvio');

                const filtroLocal =
                    document.getElementById('filtroLocal');

                const filas =
                    document.querySelectorAll('.fila-envio');

                const cantidadResultados =
                    document.getElementById('cantidadResultados');

                const sinResultados =
                    document.getElementById('sinResultados');

                const limpiarBusqueda =
                    document.getElementById('limpiarBusqueda');

                const limpiarFiltros =
                    document.getElementById('limpiarFiltros');


                /*
                |--------------------------------------------------------------------------
                | TARJETAS
                |--------------------------------------------------------------------------
                */

                const cardMovimientos =
                    document.getElementById('cardMovimientos');

                const cardUnidades =
                    document.getElementById('cardUnidades');

                const cardLocales =
                    document.getElementById('cardLocales');

                const cardOTs =
                    document.getElementById('cardOTs');


                /*
                |--------------------------------------------------------------------------
                | FILTRAR TABLA
                |--------------------------------------------------------------------------
                */

                function filtrarTabla() {

                    const texto =
                        buscador.value.toLowerCase().trim();

                    const local =
                        filtroLocal.value.toLowerCase().trim();


                    let encontrados = 0;

                    let totalUnidadesFiltradas = 0;

                    let localesFiltrados = new Set();

                    let otsFiltradas = new Set();


                    /*
                    |--------------------------------------------------------------------------
                    | RECORRER FILAS
                    |--------------------------------------------------------------------------
                    */

                    filas.forEach(function(fila) {

                        const contenido =
                            fila.dataset.busqueda.toLowerCase();

                        const filaLocal =
                            fila.dataset.local.toLowerCase();


                        const coincideTexto =
                            texto === '' ||
                            contenido.includes(texto);


                        const coincideLocal =
                            local === '' ||
                            filaLocal === local;


                        /*
                        |--------------------------------------------------------------------------
                        | MOSTRAR
                        |--------------------------------------------------------------------------
                        */

                        if (coincideTexto && coincideLocal) {

                            fila.style.display = '';

                            encontrados++;


                            /*
                            | SUMAR UNIDADES
                            */

                            totalUnidadesFiltradas +=
                                parseInt(
                                    fila.dataset.cantidad || 0,
                                    10
                                );


                            /*
                            | LOCALES ÚNICOS
                            */

                            if (fila.dataset.local) {

                                localesFiltrados.add(
                                    fila.dataset.local
                                );

                            }


                            /*
                            | OTs ÚNICAS
                            */

                            if (fila.dataset.ot) {

                                otsFiltradas.add(
                                    fila.dataset.ot
                                );

                            }

                        } else {

                            fila.style.display = 'none';

                        }

                    });


                    /*
                    |--------------------------------------------------------------------------
                    | ACTUALIZAR CANTIDAD DE RESULTADOS
                    |--------------------------------------------------------------------------
                    */

                    cantidadResultados.textContent =
                        encontrados.toLocaleString('es-PY');


                    /*
                    |--------------------------------------------------------------------------
                    | ACTUALIZAR TARJETAS
                    |--------------------------------------------------------------------------
                    */

                    cardMovimientos.textContent =
                        encontrados.toLocaleString('es-PY');


                    cardUnidades.textContent =
                        totalUnidadesFiltradas.toLocaleString('es-PY');


                    cardLocales.textContent =
                        localesFiltrados.size.toLocaleString('es-PY');


                    cardOTs.textContent =
                        otsFiltradas.size.toLocaleString('es-PY');


                    /*
                    |--------------------------------------------------------------------------
                    | SIN RESULTADOS
                    |--------------------------------------------------------------------------
                    */

                    if (encontrados === 0 && filas.length > 0) {

                        sinResultados.classList.remove('d-none');

                    } else {

                        sinResultados.classList.add('d-none');

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | BUSCAR
                |--------------------------------------------------------------------------
                */

                buscador.addEventListener(
                    'input',
                    filtrarTabla
                );


                /*
                |--------------------------------------------------------------------------
                | FILTRO LOCAL
                |--------------------------------------------------------------------------
                */

                filtroLocal.addEventListener(
                    'change',
                    filtrarTabla
                );


                /*
                |--------------------------------------------------------------------------
                | LIMPIAR BÚSQUEDA
                |--------------------------------------------------------------------------
                */

                limpiarBusqueda.addEventListener(
                    'click',
                    function() {

                        buscador.value = '';

                        filtrarTabla();

                        buscador.focus();

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | LIMPIAR TODOS LOS FILTROS
                |--------------------------------------------------------------------------
                */

                limpiarFiltros.addEventListener(
                    'click',
                    function() {

                        buscador.value = '';

                        filtroLocal.value = '';

                        filtrarTabla();

                    }
                );


            });
        </script>
@endpush

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/control-terminacion.css') }}?v=20260918-3">
@endpush
