@extends('layouts.app')

@section('title', 'Inicio | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Resumen operativo"
        subtitle="Estado general de lotes, transferencias y unidades de redistribución."
        icon="fas fa-chart-line">
        <a href="{{ route('RedistribucionSugeridas.lotes') }}" class="btn btn-primary">
            <i class="fas fa-layer-group"></i>
            Ver lotes
        </a>
    </x-page-header>

    <div class="content px-3">
        <div class="sm-home-grid">
            <article class="sm-home-kpi">
                <div class="sm-home-kpi__head">
                    <span class="sm-home-kpi__label">Total de lotes</span>
                    <span class="sm-home-kpi__icon"><i class="fas fa-layer-group"></i></span>
                </div>
                <div class="sm-home-kpi__value">{{ number_format($totalLotes) }}</div>
                <div class="sm-home-kpi__meta">Lotes registrados</div>
            </article>

            <article class="sm-home-kpi">
                <div class="sm-home-kpi__head">
                    <span class="sm-home-kpi__label">Generados</span>
                    <span class="sm-home-kpi__icon"><i class="fas fa-file-alt"></i></span>
                </div>
                <div class="sm-home-kpi__value">{{ number_format($lotesGenerados) }}</div>
                <div class="sm-home-kpi__meta">Pendientes de iniciar</div>
            </article>

            <article class="sm-home-kpi">
                <div class="sm-home-kpi__head">
                    <span class="sm-home-kpi__label">En proceso</span>
                    <span class="sm-home-kpi__icon"><i class="fas fa-sync-alt"></i></span>
                </div>
                <div class="sm-home-kpi__value">{{ number_format($lotesEnProceso) }}</div>
                <div class="sm-home-kpi__meta">Con movimiento activo</div>
            </article>

            <article class="sm-home-kpi">
                <div class="sm-home-kpi__head">
                    <span class="sm-home-kpi__label">Finalizados</span>
                    <span class="sm-home-kpi__icon"><i class="fas fa-check"></i></span>
                </div>
                <div class="sm-home-kpi__value">{{ number_format($lotesFinalizados) }}</div>
                <div class="sm-home-kpi__meta">Lotes completados</div>
            </article>
        </div>

        <div class="sm-home-layout">
            <div>
                <div class="card sm-data-card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-0">Actividad reciente</h3>
                            <small class="text-muted">Últimos lotes con su avance real.</small>
                        </div>
                        <span class="badge badge-light">{{ number_format($totalTransferencias) }} transferencias</span>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Lote</th>
                                        <th>Fecha</th>
                                        <th class="text-right">Unidades</th>
                                        <th class="text-right">Finalizadas</th>
                                        <th>Avance</th>
                                        <th>Estado</th>
                                        <th class="text-right">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ultimosLotes as $lote)
                                        <tr>
                                            <td><strong>{{ $lote->numero_lote }}</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($lote->fecha_generacion)->format('d/m/Y H:i') }}</td>
                                            <td class="text-right">{{ number_format($lote->cantidad_unidades) }}</td>
                                            <td class="text-right">{{ number_format($lote->unidades_finalizadas) }}</td>
                                            <td style="min-width: 130px;">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <small>{{ number_format($lote->porcentaje_avance, 1) }}%</small>
                                                    <small class="text-muted">
                                                        {{ $lote->transferencias_finalizadas }}/{{ $lote->cantidad_transferencias }}
                                                    </small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ min(100, $lote->porcentaje_avance) }}%"></div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($lote->estado === 'FINALIZADO')
                                                    <span class="badge badge-success">Finalizado</span>
                                                @elseif ($lote->estado === 'EN PROCESO')
                                                    <span class="badge badge-info">En proceso</span>
                                                @else
                                                    <span class="badge badge-warning">{{ ucfirst(strtolower($lote->estado)) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('RedistribucionSugeridas.lote', ['id' => $lote->id]) }}"
                                                    class="btn btn-default sm-icon-button" title="Ver lote">
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No hay lotes registrados.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Indicadores de transferencias</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <small class="text-muted d-block">Pendientes</small>
                                <strong class="d-block mt-1">{{ number_format($transferenciasPendientes) }}</strong>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <small class="text-muted d-block">En proceso</small>
                                <strong class="d-block mt-1">{{ number_format($transferenciasEnProceso) }}</strong>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Finalizadas</small>
                                <strong class="d-block mt-1">{{ number_format($transferenciasFinalizadas) }}</strong>
                            </div>
                        </div>

                        <hr>

                        <div class="sm-home-stat-list">
                            <div>
                                <div class="sm-home-stat-row">
                                    <span>Finalización de transferencias</span>
                                    <strong>{{ number_format($porcentajeFinalizacion, 1) }}%</strong>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-primary" style="width: {{ min(100, $porcentajeFinalizacion) }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="sm-home-stat-row">
                                    <span>Finalización de unidades</span>
                                    <strong>{{ number_format($porcentajeUnidadesFinalizadas, 1) }}%</strong>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-success"
                                        style="width: {{ min(100, $porcentajeUnidadesFinalizadas) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside>
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Unidades</h3>
                    </div>
                    <div class="card-body">
                        <div class="sm-home-stat-list">
                            <div class="sm-home-stat-row">
                                <span>Total</span>
                                <strong>{{ number_format($totalUnidades) }}</strong>
                            </div>
                            <div class="sm-home-stat-row">
                                <span>Pendientes</span>
                                <strong>{{ number_format($unidadesPendientes) }}</strong>
                            </div>
                            <div class="sm-home-stat-row">
                                <span>En proceso</span>
                                <strong>{{ number_format($unidadesEnProceso) }}</strong>
                            </div>
                            <div class="sm-home-stat-row">
                                <span>Finalizadas</span>
                                <strong>{{ number_format($unidadesFinalizadas) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Atención requerida</h3>
                    </div>
                    <div class="card-body">
                        <div class="sm-home-attention">
                            @forelse ($lotesAtencion as $lote)
                                <div class="sm-home-attention__item">
                                    <div>
                                        <strong>{{ $lote->numero_lote }}</strong>
                                        <small>
                                            @if ($lote->estado === 'GENERADO')
                                                Pendiente de iniciar
                                            @else
                                                {{ $lote->transferencias_finalizadas }} de
                                                {{ $lote->cantidad_transferencias }} transferencias
                                            @endif
                                        </small>
                                    </div>

                                    <a href="{{ route('RedistribucionSugeridas.lote', ['id' => $lote->id]) }}"
                                        class="btn btn-default sm-icon-button" title="Abrir lote">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            @empty
                                <p class="text-muted mb-0">No hay lotes pendientes de atención.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
