@extends('layouts.app')

@section('title', 'Detalle de lote | ' . config('app.name'))

@section('content')
    <x-page-header
        :title="'Lote ' . $lote->numero_lote"
        subtitle="Transferencias agrupadas para procesamiento de redistribución."
        icon="fas fa-layer-group">
        @switch($lote->estado)
            @case('GENERADO')
                <span class="badge badge-warning">Generado</span>
            @break
            @case('EN PROCESO')
                <span class="badge badge-info">En proceso</span>
            @break
            @case('FINALIZADO')
                <span class="badge badge-success">Finalizado</span>
            @break
            @default
                <span class="badge badge-light">{{ $lote->estado }}</span>
        @endswitch
        <a href="{{ route('RedistribucionSugeridas.lotes') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </x-page-header>

    <div class="content px-3 redistribucion-lote-page">
        <div class="container-fluid px-0">
            {{-- ===================================================== --}}
            {{-- KPIs --}}
            {{-- ===================================================== --}}

            <div class="row mb-4">

                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="lote-kpi">

                        <div class="lote-kpi-icon blue">
                            <i class="fas fa-exchange-alt"></i>
                        </div>

                        <div>

                            <span>
                                TRANSFERENCIAS
                            </span>

                            <strong>
                                {{ number_format($lote->total_transferencias) }}
                            </strong>

                            <small>
                                Movimientos del lote
                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="lote-kpi">

                        <div class="lote-kpi-icon purple">
                            <i class="fas fa-boxes"></i>
                        </div>

                        <div>

                            <span>
                                PRODUCTOS
                            </span>

                            <strong>
                                {{ number_format($lote->total_productos) }}
                            </strong>

                            <small>
                                Códigos diferentes
                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="lote-kpi">

                        <div class="lote-kpi-icon orange">
                            <i class="fas fa-cubes"></i>
                        </div>

                        <div>

                            <span>
                                UNIDADES
                            </span>

                            <strong>
                                {{ number_format($lote->total_unidades) }}
                            </strong>

                            <small>
                                Total a transferir
                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-xl-3 col-md-6 mb-3">

                    <div class="lote-kpi">

                        <div class="lote-kpi-icon green">
                            <i class="fas fa-calendar-alt"></i>
                        </div>

                        <div>

                            <span>
                                GENERADO
                            </span>

                            <strong class="date-value">
                                {{ optional($lote->fecha_generacion)->format('d/m/Y') }}
                            </strong>

                            <small>
                                {{ optional($lote->fecha_generacion)->format('H:i') }}
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- INFORMACIÓN --}}
            {{-- ===================================================== --}}

            <div class="card lote-card mb-4">

                <div class="card-header lote-card-header">

                    <div>

                        <h5>
                            <i class="fas fa-info-circle"></i>
                            Información del lote
                        </h5>

                        <small>
                            Identificación y control del procesamiento
                        </small>

                    </div>

                    <span class="lot-id">
                        ID #{{ $lote->id }}
                    </span>

                </div>


                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="lote-info">

                                <span>
                                    NÚMERO DE LOTE
                                </span>

                                <strong>
                                    {{ $lote->numero_lote }}
                                </strong>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="lote-info">

                                <span>
                                    USUARIO GENERACIÓN
                                </span>

                                <strong>
                                    {{ $lote->usuario_generacion ?? 'SISTEMA' }}
                                </strong>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="lote-info">

                                <span>
                                    FECHA GENERACIÓN
                                </span>

                                <strong>
                                    {{ optional($lote->fecha_generacion)->format('d/m/Y H:i') }}
                                </strong>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="lote-info">

                                <span>
                                    ESTADO
                                </span>

                                <strong
                                    class="
                                    @if ($lote->estado === 'FINALIZADO') text-success
                                    @elseif ($lote->estado === 'EN PROCESO')
                                        text-warning
                                    @else
                                        text-primary @endif
                                ">
                                    {{ $lote->estado }}
                                </strong>

                            </div>

                        </div>

                    </div>


                    @if ($lote->observacion)
                        <div class="lote-observation mt-4">

                            <i class="fas fa-comment-alt"></i>

                            <div>

                                <strong>
                                    Observación
                                </strong>

                                <p>
                                    {{ $lote->observacion }}
                                </p>

                            </div>

                        </div>
                    @endif

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- TABLA MASIVA --}}
            {{-- ===================================================== --}}

            <div class="card lote-card">

                <div class="card-header lote-card-header">

                    <div>

                        <h5>
                            <i class="fas fa-list-ul"></i>
                            Transferencias del lote
                        </h5>

                        <small>
                            Detalle completo de las operaciones incluidas
                        </small>

                    </div>


                    <div class="table-tools">

                        <div class="table-search">

                            <i class="fas fa-search"></i>

                            <input type="text" id="buscarLote" placeholder="Buscar código, origen o destino..."
                                autocomplete="off">

                        </div>

                    </div>

                </div>


                <div class="table-responsive">

                    <table class="table lote-table" id="tablaLote">

                        <thead>

                            <tr>

                                <th>
                                    #
                                </th>

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

                            @forelse($lote->detalles as $detalle)
                                <tr class="lote-row">

                                    <td class="number-cell">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- PRODUCTO --}}

                                    <td>

                                        <div class="lote-product">

                                            <div class="product-icon">
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


                                    {{-- ORIGEN --}}

                                    <td>

                                        <div class="transfer-location">

                                            <div class="transfer-icon origin">

                                                <i class="fas fa-arrow-up"></i>

                                            </div>

                                            <div>

                                                <strong>
                                                    {{ optional($detalle->origen)->suc_descri ?? $detalle->sucursal_origen }}
                                                </strong>

                                                <small>
                                                    SUCURSAL ORIGEN
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- DESTINO --}}

                                    <td>

                                        <div class="transfer-location">

                                            <div class="transfer-icon destination">

                                                <i class="fas fa-arrow-down"></i>

                                            </div>

                                            <div>

                                                <strong>
                                                    {{ optional($detalle->destino)->suc_descri ?? $detalle->sucursal_destino }}
                                                </strong>

                                                <small>
                                                    SUCURSAL DESTINO
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- CANTIDAD --}}

                                    <td class="text-center">

                                        <span class="lote-quantity">

                                            {{ number_format($detalle->cantidad) }}

                                        </span>

                                    </td>


                                    {{-- ESTADO --}}

                                    <td class="text-center">

                                        @switch($detalle->estado)
                                            @case('PENDIENTE')
                                                <span class="detail-badge pending">

                                                    <span></span>

                                                    PENDIENTE

                                                </span>
                                            @break

                                            @case('EN PROCESO')
                                                <span class="detail-badge process">

                                                    <span></span>

                                                    EN PROCESO

                                                </span>
                                            @break

                                            @case('FINALIZADO')
                                                <span class="detail-badge finished">

                                                    <span></span>

                                                    FINALIZADO

                                                </span>
                                            @break

                                            @default
                                                <span class="detail-badge default">

                                                    {{ $detalle->estado }}

                                                </span>
                                        @endswitch

                                    </td>

                                </tr>

                                @empty

                                    <tr>

                                        <td colspan="6">

                                            <div class="empty-lote">

                                                <i class="fas fa-inbox"></i>

                                                <h5>
                                                    Lote sin transferencias
                                                </h5>

                                                <p>
                                                    No existen detalles asociados a este lote.
                                                </p>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- ================================================= --}}
                    {{-- FOOTER --}}
                    {{-- ================================================= --}}

                    <div class="lote-actions">

                        <a href="{{ route('RedistribucionSugeridas.lotes') }}" class="btn btn-light lote-btn">

                            <i class="fas fa-arrow-left"></i>

                            Volver

                        </a>


                        <div class="actions-right">


                            {{-- ========================================= --}}
                            {{-- GENERADO --}}
                            {{-- ========================================= --}}

                            @if ($lote->estado === 'GENERADO')
                                @can('redistribucionsugerencia procesarLote')
                                    <button type="button" class="btn btn-outline-primary lote-btn" id="btnProcesarLote">

                                        <i class="fas fa-play"></i>

                                        Procesar lote

                                    </button>
                                @endcan


                                {{-- ========================================= --}}
                                {{-- EN PROCESO --}}
                                {{-- ========================================= --}}
                            @elseif ($lote->estado === 'EN PROCESO')
                                @can('redistribucionsugerencia finalizarLote')
                                    <button type="button" class="btn btn-success lote-btn-main" id="btnFinalizarLote">

                                        <i class="fas fa-check"></i>

                                        Finalizar lote

                                    </button>
                                @endcan


                                {{-- ========================================= --}}
                                {{-- FINALIZADO --}}
                                {{-- ========================================= --}}
                            @elseif ($lote->estado === 'FINALIZADO')
                                <span class="lote-finished-message">

                                    <i class="fas fa-check-circle"></i>

                                    Lote finalizado correctamente

                                </span>
                            @endif


                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- CSS --}}
        {{-- ========================================================= --}}

        


        {{-- ========================================================= --}}
        {{-- JAVASCRIPT --}}
        {{-- ========================================================= --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {


                /* =========================================================
                   BUSCADOR
                   ========================================================= */

                const buscar = document.getElementById('buscarLote');

                if (buscar) {

                    buscar.addEventListener('input', function() {

                        const texto = this.value
                            .toLowerCase()
                            .trim();

                        document
                            .querySelectorAll('.lote-row')
                            .forEach(function(row) {

                                const contenido =
                                    row.textContent.toLowerCase();

                                row.style.display =
                                    contenido.includes(texto) ?
                                    '' :
                                    'none';

                            });

                    });

                }


                /* =========================================================
                   PROCESAR LOTE
                   GENERADO -> EN PROCESO
                   ========================================================= */

                const btnProcesar =
                    document.getElementById('btnProcesarLote');

                if (btnProcesar) {

                    btnProcesar.addEventListener('click', function() {

                        Swal.fire({

                            icon: 'question',

                            title: '¿Procesar lote?',

                            html: 'Se iniciará el procesamiento del lote ' +
                                '<strong>{{ $lote->numero_lote }}</strong>.' +
                                '<br><br>' +
                                'Transferencias: <strong>{{ number_format($lote->total_transferencias) }}</strong>' +
                                '<br>' +
                                'Unidades: <strong>{{ number_format($lote->total_unidades) }}</strong>',

                            showCancelButton: true,

                            confirmButtonText: 'Sí, procesar',

                            cancelButtonText: 'Cancelar',

                            reverseButtons: true

                        }).then(function(result) {

                            if (!result.isConfirmed) {
                                return;
                            }


                            /* -----------------------------------------
                               LOADING
                               ----------------------------------------- */

                            Swal.fire({

                                title: 'Procesando lote...',

                                text: 'Por favor espere.',

                                allowOutsideClick: false,

                                allowEscapeKey: false,

                                didOpen: function() {

                                    Swal.showLoading();

                                }

                            });
                            const btnProcesar = document.getElementById('btnProcesarLote');

                            if (btnProcesar) {

                                btnProcesar.addEventListener('click', function() {

                                    Swal.fire({

                                        icon: 'question',

                                        title: '¿Procesar lote?',

                                        html: 'Se iniciará el procesamiento del lote ' +
                                            '<strong>{{ $lote->numero_lote }}</strong>.' +
                                            '<br><br>' +
                                            'Transferencias: <strong>{{ number_format($lote->total_transferencias) }}</strong>' +
                                            '<br>' +
                                            'Unidades: <strong>{{ number_format($lote->total_unidades) }}</strong>',

                                        showCancelButton: true,

                                        confirmButtonText: 'Sí, procesar',

                                        cancelButtonText: 'Cancelar',

                                        reverseButtons: true

                                    }).then(function(result) {

                                        if (result.isConfirmed) {

                                            const form = document.createElement('form');

                                            form.method = 'POST';

                                            form.action =
                                                "{{ route('RedistribucionSugeridas.procesarLote', $lote->id) }}";

                                            const csrf = document.createElement(
                                                'input');

                                            csrf.type = 'hidden';

                                            csrf.name = '_token';

                                            csrf.value = "{{ csrf_token() }}";

                                            form.appendChild(csrf);

                                            document.body.appendChild(form);

                                            form.submit();
                                        }

                                    });

                                });

                            }

                            const btnFinalizar = document.getElementById('btnFinalizarLote');

                            if (btnFinalizar) {

                                btnFinalizar.addEventListener('click', function() {

                                    Swal.fire({

                                        icon: 'question',

                                        title: '¿Finalizar lote?',

                                        html: '¿Está seguro de finalizar el lote ' +
                                            '<strong>{{ $lote->numero_lote }}</strong>?' +
                                            '<br><br>' +
                                            'Una vez finalizado, no podrá volver a procesarse.',

                                        showCancelButton: true,

                                        confirmButtonText: 'Sí, finalizar',

                                        cancelButtonText: 'Cancelar',

                                        reverseButtons: true

                                    }).then(function(result) {

                                        if (result.isConfirmed) {

                                            const form = document.createElement('form');

                                            form.method = 'POST';

                                            form.action =
                                                "{{ route('RedistribucionSugeridas.finalizarLote', $lote->id) }}";

                                            const csrf = document.createElement(
                                                'input');

                                            csrf.type = 'hidden';

                                            csrf.name = '_token';

                                            csrf.value = "{{ csrf_token() }}";

                                            form.appendChild(csrf);

                                            document.body.appendChild(form);

                                            form.submit();
                                        }

                                    });

                                });

                            }


                            /* -----------------------------------------
                               REQUEST
                               ----------------------------------------- */

                            fetch(
                                    "{{ route('RedistribucionSugeridas.procesarLote', $lote->id) }}", {

                                        method: 'POST',

                                        headers: {

                                            'Content-Type': 'application/json',

                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',

                                            'Accept': 'application/json'

                                        },

                                        body: JSON.stringify({})

                                    }
                                )

                                .then(async function(response) {

                                    const data =
                                        await response.json();

                                    if (!response.ok) {

                                        throw new Error(
                                            data.message ||
                                            'Error procesando el lote.'
                                        );

                                    }

                                    return data;

                                })

                                .then(function(data) {

                                    Swal.fire({

                                        icon: 'success',

                                        title: 'Lote procesado',

                                        text: data.message ||
                                            'El lote pasó a EN PROCESO.',

                                        confirmButtonText: 'Aceptar'

                                    }).then(function() {

                                        /*
                                         * Recargamos para que Blade
                                         * detecte EN PROCESO
                                         */

                                        window.location.reload();

                                    });

                                })

                                .catch(function(error) {

                                    console.error(
                                        'Error procesando lote:',
                                        error
                                    );

                                    Swal.fire({

                                        icon: 'error',

                                        title: 'Error',

                                        text: error.message ||
                                            'No se pudo procesar el lote.',

                                        confirmButtonText: 'Aceptar'

                                    });

                                });

                        });

                    });

                }


                /* =========================================================
                   FINALIZAR LOTE
                   EN PROCESO -> FINALIZADO
                   ========================================================= */

                const btnFinalizar =
                    document.getElementById('btnFinalizarLote');

                if (btnFinalizar) {

                    btnFinalizar.addEventListener('click', function() {

                        Swal.fire({

                            icon: 'warning',

                            title: '¿Finalizar lote?',

                            html: 'El lote ' +
                                '<strong>{{ $lote->numero_lote }}</strong>' +
                                ' será marcado como <strong>FINALIZADO</strong>.' +
                                '<br><br>' +
                                'Esta acción indica que las transferencias fueron procesadas.',

                            showCancelButton: true,

                            confirmButtonText: 'Sí, finalizar',

                            cancelButtonText: 'Cancelar',

                            reverseButtons: true

                        }).then(function(result) {

                            if (!result.isConfirmed) {
                                return;
                            }


                            /* -----------------------------------------
                               LOADING
                               ----------------------------------------- */

                            Swal.fire({

                                title: 'Finalizando lote...',

                                text: 'Por favor espere.',

                                allowOutsideClick: false,

                                allowEscapeKey: false,

                                didOpen: function() {

                                    Swal.showLoading();

                                }

                            });


                            /* -----------------------------------------
                               REQUEST
                               ----------------------------------------- */

                            fetch(
                                    "{{ route('RedistribucionSugeridas.finalizarLote', $lote->id) }}", {

                                        method: 'POST',

                                        headers: {

                                            'Content-Type': 'application/json',

                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',

                                            'Accept': 'application/json'

                                        },

                                        body: JSON.stringify({})

                                    }
                                )

                                .then(async function(response) {

                                    const data =
                                        await response.json();

                                    if (!response.ok) {

                                        throw new Error(
                                            data.message ||
                                            'Error finalizando el lote.'
                                        );

                                    }

                                    return data;

                                })

                                .then(function(data) {

                                    Swal.fire({

                                        icon: 'success',

                                        title: 'Lote finalizado',

                                        text: data.message ||
                                            'El lote fue finalizado correctamente.',

                                        confirmButtonText: 'Aceptar'

                                    }).then(function() {

                                        window.location.reload();

                                    });

                                })

                                .catch(function(error) {

                                    console.error(
                                        'Error finalizando lote:',
                                        error
                                    );

                                    Swal.fire({

                                        icon: 'error',

                                        title: 'Error',

                                        text: error.message ||
                                            'No se pudo finalizar el lote.',

                                        confirmButtonText: 'Aceptar'

                                    });

                                });

                        });

                    });

                }

            });
        </script>
    @endsection

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/redistribucion-lote.css') }}?v=20260918-2">
@endpush
