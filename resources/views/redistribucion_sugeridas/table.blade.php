<div class="card-body p-0 redistribucion-module">

    {{-- ========================================================= --}}
    {{-- KPIs --}}
    {{-- ========================================================= --}}

    <div class="px-4 pt-4 pb-2">
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="erp-kpi">
                    <div class="erp-kpi-icon primary">
                        <i class="fas fa-random"></i>
                    </div>

                    <div class="erp-kpi-info">
                        <span class="erp-kpi-label">SUGERENCIAS</span>

                        <strong class="erp-kpi-value">
                            {{ number_format($sugerencias->count()) }}
                        </strong>

                        <small>
                            Movimientos generados
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="erp-kpi">
                    <div class="erp-kpi-icon warning">
                        <i class="fas fa-boxes"></i>
                    </div>

                    <div class="erp-kpi-info">
                        <span class="erp-kpi-label">UNIDADES</span>

                        <strong class="erp-kpi-value">
                            {{ number_format($sugerencias->sum('cantidad')) }}
                        </strong>

                        <small>
                            Unidades a redistribuir
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="erp-kpi">
                    <div class="erp-kpi-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>

                    <div class="erp-kpi-info">
                        <span class="erp-kpi-label">PENDIENTES</span>

                        <strong class="erp-kpi-value">
                            {{ number_format($sugerencias->where('estado', 'PENDIENTE')->count()) }}
                        </strong>

                        <small>
                            Requieren aprobación
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="erp-kpi">
                    <div class="erp-kpi-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <div class="erp-kpi-info">
                        <span class="erp-kpi-label">APROBADAS</span>

                        <strong class="erp-kpi-value">
                            {{ number_format($sugerencias->where('estado', 'APROBADA')->count()) }}
                        </strong>

                        <small>
                            Movimientos aprobados
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- TOOLBAR --}}
    {{-- ========================================================= --}}

    <div class="px-4 pb-3">

        <div class="erp-toolbar">

            <div class="erp-toolbar-title">

                <div class="erp-toolbar-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>

                <div>
                    <strong>Gestión de Redistribución</strong>

                    <span>
                        Seleccione los movimientos que desea procesar
                    </span>
                </div>

            </div>

            <div class="erp-toolbar-actions">

                <div class="erp-selection">

                    <span class="erp-selection-icon">
                        <i class="fas fa-check"></i>
                    </span>

                    <div>
                        <strong id="contadorSeleccionados">0</strong>
                        <small>seleccionados</small>
                    </div>

                </div>

                <div class="erp-divider"></div>

                @can('redistribucionsugerencia aprobar')
                    <button type="button" class="btn btn-success erp-action-btn" id="btnAprobar">

                        <i class="fas fa-check mr-1"></i>
                        Aprobar

                    </button>
                @endcan
                @can('redistribucionsugerencia rechazar')
                    <button type="button" class="btn btn-danger erp-action-btn" id="btnRechazar">
                        <i class="fas fa-times mr-1"></i>
                        Rechazar
                    </button>
                @endcan
                {{-- @can('redistribucionsugerencia automatico') --}}
                    <button type="button" class="btn btn-outline-primary erp-action-btn" id="btnAutomatico">

                        <i class="fas fa-robot mr-1"></i>
                        Automático

                    </button>
                {{-- @endcan --}}

            </div>

        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- FILTROS --}}
    {{-- ========================================================= --}}

    <div class="px-4 pb-3">

        <div class="erp-filter">

            <div class="erp-search">

                <i class="fas fa-search"></i>

                <input type="text" id="buscarRedistribucion" placeholder="Buscar producto, sucursal o motivo..."
                    autocomplete="off">

            </div>

            <div class="erp-status-filter">

                <select id="filtroEstado" class="form-control">

                    <option value="">
                        Todos los estados
                    </option>

                    <option value="PENDIENTE">
                        Pendientes
                    </option>

                    <option value="APROBADA">
                        Aprobadas
                    </option>

                    <option value="RECHAZADA">
                        Rechazadas
                    </option>

                    <option value="EN PROCESO">
                        En proceso
                    </option>

                </select>

            </div>

            <div class="erp-results">

                <span>
                    Mostrando
                </span>

                <strong id="cantidadVisible">
                    {{ $sugerencias->count() }}
                </strong>

                <span>
                    movimientos
                </span>

            </div>

        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- TABLA --}}
    {{-- ========================================================= --}}

    <div class="px-4 pb-4">

        <div class="erp-table-container">

            <table class="table erp-table" id="redistribucion-sugeridas-table">

                <thead>

                    <tr>

                        <th class="erp-check-column">

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="seleccionarTodosTabla">

                                <label class="custom-control-label" for="seleccionarTodosTabla">
                                </label>
                            </div>

                        </th>

                        <th>PRODUCTO</th>

                        <th>ORIGEN</th>

                        <th>DESTINO</th>

                        <th class="text-center">
                            CANTIDAD
                        </th>

                        <th class="text-center">
                            STOCK
                        </th>

                        <th class="text-center">
                            VENTAS
                        </th>

                        <th>
                            MOTIVO
                        </th>

                        <th class="text-center">
                            ESTADO
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($sugerencias as $redistribucionSugerida)
                        <tr class="redistribucion-row" data-estado="{{ $redistribucionSugerida->estado }}">

                            {{-- CHECKBOX --}}

                            <td class="text-center">

                                @if ($redistribucionSugerida->estado === 'PENDIENTE')
                                    <div class="custom-control custom-checkbox">

                                        <input type="checkbox" class="custom-control-input sugerencia-checkbox"
                                            id="sugerencia_{{ $redistribucionSugerida->id }}"
                                            value="{{ $redistribucionSugerida->id }}">

                                        <label class="custom-control-label"
                                            for="sugerencia_{{ $redistribucionSugerida->id }}">
                                        </label>

                                    </div>
                                @else
                                    <span class="erp-locked">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                @endif

                            </td>

                            {{-- PRODUCTO --}}

                            <td>

                                <div class="erp-product">

                                    <div class="erp-product-icon">
                                        <i class="fas fa-barcode"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $redistribucionSugerida->codigo }}
                                        </strong>

                                        <span>
                                            Código de producto
                                        </span>

                                    </div>

                                </div>

                            </td>

                            {{-- ORIGEN --}}

                            <td>

                                <div class="erp-location">

                                    <div class="erp-location-icon origin">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $redistribucionSugerida->origen->suc_descri ?? $redistribucionSugerida->sucursal_origen }}
                                        </strong>

                                        <span>
                                            Sucursal origen
                                        </span>

                                    </div>

                                </div>

                            </td>

                            {{-- DESTINO --}}

                            <td>

                                <div class="erp-location">

                                    <div class="erp-location-icon destination">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $redistribucionSugerida->destino->suc_descri ?? $redistribucionSugerida->sucursal_destino }}
                                        </strong>

                                        <span>
                                            Sucursal destino
                                        </span>

                                    </div>

                                </div>

                            </td>

                            {{-- CANTIDAD --}}

                            <td class="text-center">

                                <div class="erp-quantity">

                                    <strong>
                                        {{ number_format($redistribucionSugerida->cantidad) }}
                                    </strong>

                                    <span>
                                        unidades
                                    </span>

                                </div>

                            </td>

                            {{-- STOCK --}}

                            <td>

                                <div class="erp-metric">

                                    <div>
                                        <span>Origen</span>
                                        <strong>
                                            {{ number_format($redistribucionSugerida->stock_origen) }}
                                        </strong>
                                    </div>

                                    <i class="fas fa-arrow-right"></i>

                                    <div>
                                        <span>Destino</span>

                                        <strong
                                            class="{{ $redistribucionSugerida->stock_destino <= 0 ? 'danger' : '' }}">
                                            {{ number_format($redistribucionSugerida->stock_destino) }}
                                        </strong>
                                    </div>

                                </div>

                            </td>

                            {{-- VENTAS --}}

                            <td>

                                <div class="erp-metric">

                                    <div>
                                        <span>Origen</span>

                                        <strong>
                                            {{ number_format($redistribucionSugerida->venta_origen) }}
                                        </strong>
                                    </div>

                                    <i class="fas fa-arrow-right"></i>

                                    <div>

                                        <span>Destino</span>

                                        <strong class="primary">
                                            {{ number_format($redistribucionSugerida->venta_destino) }}
                                        </strong>

                                    </div>

                                </div>

                            </td>

                            {{-- MOTIVO --}}

                            <td>

                                <div class="erp-reason">

                                    <i class="fas fa-info-circle"></i>

                                    <span title="{{ $redistribucionSugerida->motivo }}">
                                        {{ $redistribucionSugerida->motivo }}
                                    </span>

                                </div>

                            </td>

                            {{-- ESTADO --}}

                            <td class="text-center">

                                @switch($redistribucionSugerida->estado)
                                    @case('PENDIENTE')
                                        <span class="erp-status pending">
                                            <i class="fas fa-clock"></i>
                                            PENDIENTE
                                        </span>
                                    @break

                                    @case('APROBADA')
                                        <span class="erp-status approved">
                                            <i class="fas fa-check"></i>
                                            APROBADA
                                        </span>
                                    @break

                                    @case('RECHAZADA')
                                        <span class="erp-status rejected">
                                            <i class="fas fa-times"></i>
                                            RECHAZADA
                                        </span>
                                    @break

                                    @case('EN PROCESO')
                                        <span class="erp-status process">
                                            <i class="fas fa-spinner"></i>
                                            EN PROCESO
                                        </span>
                                    @break

                                    @default
                                        <span class="erp-status default">
                                            {{ $redistribucionSugerida->estado }}
                                        </span>
                                @endswitch

                            </td>

                        </tr>

                        @empty

                            <tr>

                                <td colspan="9">

                                    <div class="erp-empty">

                                        <div class="erp-empty-icon">
                                            <i class="fas fa-box-open"></i>
                                        </div>

                                        <h4>
                                            No hay redistribuciones
                                        </h4>

                                        <p>
                                            Ejecutá un análisis para generar propuestas de redistribución.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const seleccionarTodos = document.getElementById('seleccionarTodosTabla');
            const contador = document.getElementById('contadorSeleccionados');
            const buscar = document.getElementById('buscarRedistribucion');
            const filtroEstado = document.getElementById('filtroEstado');
            const cantidadVisible = document.getElementById('cantidadVisible');

            function obtenerCheckboxes() {
                return document.querySelectorAll('.sugerencia-checkbox');
            }

            function actualizarContador() {

                const seleccionados = document.querySelectorAll(
                    '.sugerencia-checkbox:checked'
                );

                contador.textContent = seleccionados.length;
            }

            if (seleccionarTodos) {

                seleccionarTodos.addEventListener('change', function() {

                    obtenerCheckboxes().forEach(function(checkbox) {

                        const fila = checkbox.closest('tr');

                        if (
                            fila &&
                            fila.style.display !== 'none'
                        ) {
                            checkbox.checked = seleccionarTodos.checked;
                        }

                    });

                    actualizarContador();

                });

            }

            document.addEventListener('change', function(e) {

                if (
                    e.target.classList.contains('sugerencia-checkbox')
                ) {

                    actualizarContador();

                    const todos = Array.from(
                        obtenerCheckboxes()
                    );

                    const visibles = todos.filter(function(checkbox) {

                        const fila = checkbox.closest('tr');

                        return fila &&
                            fila.style.display !== 'none';

                    });

                    const seleccionadosVisibles = visibles.filter(
                        checkbox => checkbox.checked
                    );

                    if (seleccionarTodos) {

                        seleccionarTodos.checked =
                            visibles.length > 0 &&
                            seleccionadosVisibles.length === visibles.length;

                    }

                }

            });


            function filtrarTabla() {

                const texto = buscar ?
                    buscar.value.toLowerCase().trim() :
                    '';

                const estado = filtroEstado ?
                    filtroEstado.value.toLowerCase() :
                    '';

                const filas = document.querySelectorAll(
                    '.redistribucion-row'
                );

                let visibles = 0;

                filas.forEach(function(fila) {

                    const contenido =
                        fila.textContent.toLowerCase();

                    const estadoFila =
                        (fila.dataset.estado || '').toLowerCase();

                    const coincideTexto =
                        contenido.includes(texto);

                    const coincideEstado = !estado ||
                        estadoFila === estado;

                    const mostrar =
                        coincideTexto &&
                        coincideEstado;

                    fila.style.display =
                        mostrar ? '' : 'none';

                    if (mostrar) {
                        visibles++;
                    }

                });

                if (cantidadVisible) {
                    cantidadVisible.textContent = visibles;
                }

                if (seleccionarTodos) {
                    seleccionarTodos.checked = false;
                }

                actualizarContador();
            }


            if (buscar) {
                buscar.addEventListener(
                    'input',
                    filtrarTabla
                );
            }

            if (filtroEstado) {
                filtroEstado.addEventListener(
                    'change',
                    filtrarTabla
                );
            }


            function obtenerSeleccionados() {

                const ids = [];

                document
                    .querySelectorAll('.sugerencia-checkbox:checked')
                    .forEach(function(checkbox) {

                        ids.push(checkbox.value);

                    });

                return ids;
            }


            function enviarFormulario(url, ids) {

                const form =
                    document.createElement('form');

                form.method = 'POST';
                form.action = url;

                const csrf =
                    document.createElement('input');

                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = "{{ csrf_token() }}";

                form.appendChild(csrf);

                ids.forEach(function(id) {

                    const input =
                        document.createElement('input');

                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = id;

                    form.appendChild(input);

                });

                document.body.appendChild(form);

                form.submit();
            }


            /* =====================================================
               APROBAR
            ===================================================== */

            const btnAprobar =
                document.getElementById('btnAprobar');

            if (btnAprobar) {

                btnAprobar.addEventListener(
                    'click',
                    function() {

                        const ids =
                            obtenerSeleccionados();

                        if (!ids.length) {

                            Swal.fire({
                                icon: 'warning',
                                title: 'Sin selección',
                                text: 'Seleccione al menos una sugerencia pendiente.',
                                confirmButtonText: 'Entendido'
                            });

                            return;
                        }

                        Swal.fire({

                            icon: 'question',

                            title: 'Confirmar aprobación',

                            html: 'Se aprobarán <strong>' +
                                ids.length +
                                '</strong> movimiento(s).',

                            showCancelButton: true,

                            confirmButtonText: '<i class="fas fa-check"></i> Sí, aprobar',

                            cancelButtonText: 'Cancelar',

                            reverseButtons: true

                        }).then(function(result) {

                            if (result.isConfirmed) {

                                enviarFormulario(
                                    "{{ route('RedistribucionSugeridas.aprobar') }}",
                                    ids
                                );

                            }

                        });

                    }
                );

            }


            /* =====================================================
               RECHAZAR
            ===================================================== */

            const btnRechazar =
                document.getElementById('btnRechazar');

            if (btnRechazar) {

                btnRechazar.addEventListener(
                    'click',
                    function() {

                        const ids =
                            obtenerSeleccionados();

                        if (!ids.length) {

                            Swal.fire({
                                icon: 'warning',
                                title: 'Sin selección',
                                text: 'Seleccione al menos una sugerencia pendiente.',
                                confirmButtonText: 'Entendido'
                            });

                            return;
                        }

                        Swal.fire({

                            icon: 'warning',

                            title: 'Confirmar rechazo',

                            html: 'Se rechazarán <strong>' +
                                ids.length +
                                '</strong> movimiento(s).',

                            showCancelButton: true,

                            confirmButtonText: '<i class="fas fa-times"></i> Sí, rechazar',

                            cancelButtonText: 'Cancelar',

                            reverseButtons: true

                        }).then(function(result) {

                            if (result.isConfirmed) {

                                enviarFormulario(
                                    "{{ route('RedistribucionSugeridas.rechazar') }}",
                                    ids
                                );

                            }

                        });

                    }
                );

            }


            /* =====================================================
               AUTOMÁTICO
            ===================================================== */

            const btnAutomatico =
                document.getElementById('btnAutomatico');

            if (btnAutomatico) {

                btnAutomatico.addEventListener(
                    'click',
                    function() {

                        Swal.fire({

                            icon: 'info',

                            title: 'Aprobación automática',

                            text: 'Esta función estará disponible próximamente.',

                            confirmButtonText: 'Entendido'

                        });

                    }
                );

            }

        });


        /* =========================================================
           MENSAJES DE SESIÓN
        ========================================================= */

        document.addEventListener(
            'DOMContentLoaded',
            function() {

                @if (session('success'))

                    Swal.fire({
                        icon: 'success',
                        title: 'Operación realizada',
                        text: @json(session('success')),
                        confirmButtonText: 'Entendido'
                    });
                @endif

                @if (session('warning'))

                    Swal.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: @json(session('warning')),
                        confirmButtonText: 'Entendido'
                    });
                @endif

                @if (session('error'))

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: @json(session('error')),
                        confirmButtonText: 'Entendido'
                    });
                @endif

            }
        );
    </script>

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/redistribucion-table.css') }}?v=20260918-2">
@endpush
