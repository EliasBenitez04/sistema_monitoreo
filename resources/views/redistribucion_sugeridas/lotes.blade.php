@extends('layouts.app')

@section('title', 'Gestión de lotes | ' . config('app.name'))

@section('content')
    @include('redistribucion_sugeridas.importar-remisiones')

    <x-page-header
        title="Gestión de lotes"
        subtitle="Control y seguimiento de movimientos de redistribución."
        icon="fas fa-layer-group">
        @can('redistribucionsugerencia importarRemisiones')
            <button type="button" class="btn btn-primary btn-import-remisiones" data-toggle="modal"
                data-target="#modalImportarRemisiones">
                <i class="fas fa-file-import"></i>
                Importar remisiones
            </button>
        @endcan
    </x-page-header>

    <section class="content sm-lotes-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="small-box dashboard-stat stat-warning">
                        <div class="inner">
                            <h3>{{ $procesosPendientes->sum(function ($proceso) {return $proceso->detalles->count();}) }}
                            </h3>
                            <p>Movimientos pendientes</p>
                            <div class="stat-label"><i class="fas fa-clock"></i> Requieren procesamiento</div>
                        </div>
                        <div class="icon"><i class="fas fa-clock"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="small-box dashboard-stat stat-info">
                        <div class="inner">
                            <h3>{{ $lotesGenerados->count() }}</h3>
                            <p>Lotes generados</p>
                            <div class="stat-label"><i class="fas fa-box"></i> Pendientes de iniciar</div>
                        </div>
                        <div class="icon"><i class="fas fa-box"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="small-box dashboard-stat stat-primary">
                        <div class="inner">
                            <h3>{{ $lotesEnProceso->count() }}</h3>
                            <p>Lotes en proceso</p>
                            <div class="stat-label"><i class="fas fa-cogs"></i> Operaciones activas</div>
                        </div>
                        <div class="icon"><i class="fas fa-cogs"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="small-box dashboard-stat stat-success">
                        <div class="inner">
                            <h3>{{ $lotesFinalizados->count() }}</h3>
                            <p>Lotes finalizados</p>
                            <div class="stat-label"><i class="fas fa-check-circle"></i> Procesos completados</div>
                        </div>
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <div>
                        <h3 class="dashboard-card-title">
                            <span class="section-icon warning"><i class="fas fa-clock"></i></span>
                            Movimientos pendientes de generar lote
                        </h3>
                        <span class="dashboard-card-subtitle">Procesos disponibles para consolidar en un nuevo
                            lote</span>
                    </div>
                    <div class="header-actions">
                        <span class="status-counter"><i class="fas fa-layer-group"></i>
                            {{ $procesosPendientes->count() }} procesos</span>
                    </div>
                </div>
                <div class="card-body">
                    @if ($procesosPendientes->count() == 0)
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-check"></i></div>
                            <h5>Todo está al día</h5>
                            <p>No existen movimientos pendientes para generar lotes.</p>
                        </div>
                    @else
                        @foreach ($procesosPendientes as $proceso)
                            <div class="card process-card">
                                <div class="card-header process-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <h3 class="process-title">
                                                <span class="process-id">PROCESO #{{ $proceso->id }}</span>
                                                @if (isset($proceso->fecha))
                                                    <span class="process-date"><i
                                                            class="far fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($proceso->fecha)->format('d/m/Y') }}</span>
                                                @endif
                                            </h3>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="process-actions">
                                                <span class="movement-badge"><i
                                                        class="fas fa-exchange-alt"></i>{{ $proceso->detalles->count() }}
                                                    movimientos</span>
                                                <form action="{{ route('RedistribucionSugeridas.generarLote') }}"
                                                    method="POST" class="form-generar-lote m-0">
                                                    @csrf
                                                    <input type="hidden" name="proceso_id" value="{{ $proceso->id }}">
                                                    @can('redistribucionsugerencia generarLote')
                                                        <button type="submit" class="btn btn-generate"><i
                                                                class="fas fa-layer-group"></i> Generar lote</button>
                                                    @endcan
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="55">#</th>
                                                    <th>Producto</th>
                                                    <th>Origen</th>
                                                    <th>Destino</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proceso->detalles as $detalle)
                                                    <tr>
                                                        <td><span class="text-muted">#{{ $detalle->id }}</span></td>
                                                        <td>
                                                            <span class="product-code">{{ $detalle->codigo ?? '-' }}</span>
                                                            @if (isset($detalle->producto))
                                                                <span class="product-name">{{ $detalle->producto }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="location-cell"><i
                                                                    class="fas fa-store"></i>{{ $detalle->origen->suc_descri ?? '-' }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="location-cell"><i
                                                                    class="fas fa-store"></i>{{ $detalle->destino->suc_descri ?? '-' }}</span>
                                                        </td>
                                                        <td class="text-center"><span
                                                                class="quantity">{{ $detalle->cantidad ?? 0 }}</span>
                                                        </td>
                                                        <td class="text-center"><span class="status-badge warning"><i
                                                                    class="fas fa-clock"></i>{{ $detalle->estado }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <div>
                        <h3 class="dashboard-card-title">
                            <span class="section-icon info"><i class="fas fa-box"></i></span>
                            Lotes generados
                        </h3>
                        <span class="dashboard-card-subtitle">Lotes creados y pendientes de iniciar</span>
                    </div>
                    <div class="header-actions">
                        <span class="status-counter"><i class="fas fa-box"></i> {{ $lotesGenerados->count() }}
                            lotes</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if ($lotesGenerados->count() == 0)
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                            <h5>No hay lotes pendientes</h5>
                            <p>Los nuevos lotes generados aparecerán aquí.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Lote</th>
                                        <th>Fecha generación</th>
                                        <th class="text-center">Movimientos</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotesGenerados as $lote)
                                        <tr>
                                            <td>
                                                <strong class="product-code">
                                                    LOTE #{{ $lote->id }}
                                                </strong>
                                            </td>

                                            <td>
                                                <span class="location-cell">
                                                    <i class="far fa-calendar-alt"></i>
                                                    {{ \Carbon\Carbon::parse($lote->fecha_generacion)->format('d/m/Y H:i') }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <span class="quantity">
                                                    {{ $lote->detalles->count() }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <span class="status-badge info">
                                                    <i class="fas fa-box"></i>
                                                    {{ $lote->estado }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="action-group">

                                                        {{-- VER LOTE --}}
                                                        <a href="{{ route('RedistribucionSugeridas.lote', ['id' => $lote->id]) }}"
                                                            class="btn btn-continue">
                                                            <i class="fas fa-eye"></i>
                                                            Ver lote
                                                        </a>

                                                        {{-- EXPORTAR PDF --}}
                                                        <a href="{{ route('RedistribucionSugeridas.lote.pdf', ['id' => $lote->id]) }}"
                                                            class="btn btn-pdf" target="_blank">
                                                            <i class="fas fa-file-pdf"></i> PDF
                                                        </a>

                                                        <a href="{{ route('RedistribucionSugeridas.lote.excel', ['id' => $lote->id]) }}"
                                                            class="btn btn-success">
                                                            <i class="fas fa-file-excel"></i> Excel
                                                        </a>

                                                        {{-- INICIAR --}}
                                                        @can('redistribucionsugerencia procesarLote')
                                                            <button type="button" class="btn btn-start"
                                                                onclick="iniciarLote({{ $lote->id }})">
                                                                <i class="fas fa-play"></i>
                                                                Iniciar
                                                            </button>
                                                        @endcan

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-3 d-flex justify-content-end">
                                {{ $lotesGenerados->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <div>
                        <h3 class="dashboard-card-title">
                            <span class="section-icon primary"><i class="fas fa-cogs"></i></span>
                            Lotes en proceso
                        </h3>
                        <span class="dashboard-card-subtitle">Operaciones actualmente en ejecución</span>
                    </div>
                    <div class="header-actions">
                        <span class="status-counter"><i class="fas fa-spinner"></i> {{ $lotesEnProceso->count() }}
                            activos</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if ($lotesEnProceso->count() == 0)
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-check"></i></div>
                            <h5>No hay lotes en proceso</h5>
                            <p>No existen operaciones actualmente en ejecución.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Lote</th>
                                        <th>Fecha generación</th>
                                        <th class="text-center">Movimientos</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotesEnProceso as $lote)
                                        <tr>
                                            <td><strong class="product-code">LOTE #{{ $lote->id }}</strong></td>
                                            <td><span class="location-cell"><i
                                                        class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($lote->fecha_generacion)->format('d/m/Y H:i') }}</span>
                                            </td>
                                            <td class="text-center"><span
                                                    class="quantity">{{ $lote->detalles->count() }}</span></td>
                                            <td class="text-center"><span class="status-badge primary"><i
                                                        class="fas fa-cogs"></i>{{ $lote->estado }}</span></td>
                                            <td>
                                                <div class="action-group">
                                                        <a href="{{ route('RedistribucionSugeridas.lote', ['id' => $lote->id]) }}"
                                                            class="btn btn-continue"><i class="fas fa-eye"></i>
                                                            Ver Lote</a>
                                                        {{-- EXPORTAR PDF --}}
                                                        <a href="{{ route('RedistribucionSugeridas.lote.pdf', ['id' => $lote->id]) }}"
                                                            class="btn btn-pdf" target="_blank">
                                                            <i class="fas fa-file-pdf"></i> PDF
                                                        </a>

                                                        <a href="{{ route('RedistribucionSugeridas.lote.excel', ['id' => $lote->id]) }}"
                                                            class="btn btn-success">
                                                            <i class="fas fa-file-excel"></i> Excel
                                                        </a>
                                                        {{-- @can('redistribucionsugerencia finalizarLote')
                                                            <button type="button" class="btn btn-finish"
                                                                onclick="finalizarLote({{ $lote->id }})"><i
                                                                    class="fas fa-check"></i> Finalizar</button>
                                                        @endcan --}}
                                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-3 d-flex justify-content-end">
                                {{ $lotesEnProceso->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <div>
                        <h3 class="dashboard-card-title">
                            <span class="section-icon success"><i class="fas fa-check-circle"></i></span>
                            Lotes finalizados
                        </h3>
                        <span class="dashboard-card-subtitle">Historial de operaciones completadas</span>
                    </div>
                    <div class="header-actions">
                        <span class="status-counter"><i class="fas fa-check"></i> {{ $lotesFinalizados->total() }}
                            completados</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if ($lotesFinalizados->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-history"></i></div>
                            <h5>Sin historial disponible</h5>
                            <p>Los lotes finalizados aparecerán en esta sección.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Lote</th>
                                        <th>Fecha generación</th>
                                        <th class="text-center">Movimientos</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotesFinalizados as $lote)
                                        <tr>
                                            {{-- LOTE --}}
                                            <td>
                                                <strong class="product-code">
                                                    LOTE #{{ $lote->id }}
                                                </strong>
                                            </td>

                                            {{-- FECHA --}}
                                            <td>
                                                <span class="location-cell">
                                                    <i class="far fa-calendar-alt"></i>
                                                    {{ \Carbon\Carbon::parse($lote->fecha_generacion)->format('d/m/Y H:i') }}
                                                </span>
                                            </td>

                                            {{-- MOVIMIENTOS --}}
                                            <td class="text-center">
                                                <span class="quantity">
                                                    {{ $lote->detalles->count() }}
                                                </span>
                                            </td>

                                            {{-- ESTADO --}}
                                            <td class="text-center">
                                                <span class="status-badge success">
                                                    <i class="fas fa-check-circle"></i>
                                                    {{ $lote->estado }}
                                                </span>
                                            </td>

                                            {{-- ACCIONES --}}
                                            <td>
                                                <div class="action-group">

                                                    {{-- VER LOTE --}}
                                                    <a href="{{ route('RedistribucionSugeridas.lote', ['id' => $lote->id]) }}"
                                                        class="btn btn-continue">
                                                        <i class="fas fa-eye"></i>
                                                        Ver lote
                                                    </a>

                                                    {{-- EXPORTAR PDF --}}
                                                    <a href="{{ route('RedistribucionSugeridas.lote.pdf', ['id' => $lote->id]) }}"
                                                        class="btn btn-pdf" target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                        PDF
                                                    </a>

                                                    {{-- EXPORTAR EXCEL --}}
                                                    <a href="{{ route('RedistribucionSugeridas.lote.excel', ['id' => $lote->id]) }}"
                                                        class="btn btn-success">
                                                        <i class="fas fa-file-excel"></i>
                                                        Excel
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-3 d-flex justify-content-end">
                                {{ $lotesFinalizados->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page_scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.form-generar-lote').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Generar lote?',
                        text: 'Los movimientos pendientes de este proceso serán asignados a un nuevo lote.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, generar lote',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Generando lote...',
                                text: 'Por favor espere.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: function() {
                                    Swal.showLoading();
                                }
                            });
                            form.submit();
                        }
                    });
                });
            });
        });

        function iniciarLote(loteId) {

            Swal.fire({
                title: '¿Iniciar lote?',
                text: 'El lote pasará de GENERADO a EN PROCESO.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, iniciar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then(function(result) {

                if (!result.isConfirmed) {
                    return;
                }

                Swal.fire({
                    title: 'Procesando lote...',
                    text: 'Por favor espere.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function() {
                        Swal.showLoading();
                    }
                });

                const csrfToken = document.querySelector(
                    'meta[name="csrf-token"]'
                );

                if (!csrfToken) {

                    Swal.fire({
                        title: 'Error de configuración',
                        text: 'No se encontró el token CSRF.',
                        icon: 'error'
                    });

                    console.error('NO EXISTE META CSRF');

                    return;
                }

                fetch(
                        "{{ url('/redistribucion-sugeridas/lote') }}/" +
                        loteId +
                        "/procesar", {
                            method: 'POST',

                            headers: {
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },

                            body: JSON.stringify({})
                        }
                    )

                    .then(async function(response) {

                        const texto = await response.text();

                        console.log('========== RESPUESTA SERVIDOR ==========');
                        console.log('STATUS:', response.status);
                        console.log('URL:', response.url);
                        console.log('BODY:', texto);
                        console.log('=========================================');

                        let data;

                        try {

                            data = JSON.parse(texto);

                        } catch (error) {

                            console.error(
                                'Laravel NO devolvió JSON:',
                                texto
                            );

                            throw new Error(
                                'El servidor devolvió HTML. Revisa la consola y storage/logs/laravel.log.'
                            );
                        }

                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'Error HTTP ' + response.status
                            );
                        }

                        return data;
                    })

                    .then(function(data) {

                        console.log('JSON RECIBIDO:', data);

                        if (!data.success) {

                            throw new Error(
                                data.message ||
                                'El lote no pudo procesarse.'
                            );
                        }

                        Swal.fire({
                            title: '¡Lote iniciado!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then(function() {

                            window.location.href =
                                "{{ route('RedistribucionSugeridas.lotes') }}";

                        });

                    })

                    .catch(function(error) {

                        console.error('ERROR FINAL:', error);

                        Swal.fire({
                            title: 'Error',
                            text: error.message ||
                                'Ocurrió un error al procesar el lote.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });

                    });

            });
        }

        function finalizarLote(loteId) {
            Swal.fire({
                title: '¿Finalizar lote?',
                text: 'Una vez finalizado, el lote quedará registrado como FINALIZADO.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, finalizar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then(function(result) {
                if (!result.isConfirmed) return;
                Swal.fire({
                    title: 'Finalizando lote...',
                    text: 'Por favor espere.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function() {
                        Swal.showLoading();
                    }
                });
                fetch("{{ url('/redistribucion-sugeridas/lote') }}/" + loteId + "/finalizar", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(async function(response) {
                        const texto = await response.text();

                        console.log('RESPUESTA REAL DEL SERVIDOR:', texto);

                        let data;

                        try {
                            data = JSON.parse(texto);
                        } catch (error) {
                            console.error('NO ES JSON:', texto);

                            throw new Error('El servidor devolvió HTML en lugar de JSON.');
                        }

                        if (!response.ok) {
                            throw new Error(data.message || 'Error al procesar el lote.');
                        }

                        return data;
                    })
                    .then(function(data) {
                        Swal.fire({
                            title: '¡Lote finalizado!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then(function() {
                            window.location.href = "{{ route('RedistribucionSugeridas.lotes') }}";
                        });
                    })
                    .catch(function(error) {
                        console.error(error);
                        Swal.fire({
                            title: 'Error',
                            text: error.message || 'Ocurrió un error al finalizar el lote.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    });
            });
        }

        @if (session('success'))
            Swal.fire({
                title: '¡Éxito!',
                text: @json(session('success')),
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error',
                text: @json(session('error')),
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if (session('warning'))
            Swal.fire({
                title: 'Atención',
                text: @json(session('warning')),
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
        @endif
    </script>
@endpush

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/redistribucion-lotes.css') }}?v=20260918-3">
@endpush
