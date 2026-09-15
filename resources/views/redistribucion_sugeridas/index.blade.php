@extends('layouts.app')

@section('content')
    <x-page-header
        title="Redistribución de stock"
        subtitle="Analice demanda, disponibilidad y movimientos recomendados entre sucursales."
        icon="fas fa-exchange-alt">
        @can('redistribucionsugerencia lotes')
            <a href="{{ route('RedistribucionSugeridas.lotes') }}" class="btn btn-outline-primary">
                <i class="fas fa-layer-group"></i>
                Gestión de lotes
            </a>
        @endcan
    </x-page-header>

    <div class="content px-3 redistribucion-page">
        @include('sweetalert::alert')

        <div class="card sm-filter-card mb-3">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">
                        <i class="fas fa-sliders-h text-primary mr-2"></i>
                        Parámetros de análisis
                    </h3>
                    <small class="text-muted">Defina el alcance antes de generar nuevas sugerencias.</small>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('RedistribucionSugeridas.analizar') }}" method="POST" id="formAnalisis">
                    @csrf

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-3">
                            <label for="periodo">
                                <i class="far fa-calendar-alt text-primary mr-1"></i>
                                Período <span class="text-danger">*</span>
                            </label>
                            <select name="periodo" id="periodo" class="form-control select2" required>
                                <option value="">Seleccione un período</option>
                                @foreach ($periodos as $periodo)
                                    <option value="{{ $periodo }}" {{ old('periodo') == $periodo ? 'selected' : '' }}>
                                        {{ $periodo }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Ventas y stock que se tomarán como referencia.</small>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-3">
                            <label for="grupo_plan">
                                <i class="fas fa-layer-group text-primary mr-1"></i>
                                Grupo plan
                            </label>
                            <select name="grupo_plan" id="grupo_plan" class="form-control select2">
                                <option value="">Todos los grupos</option>
                                @foreach ($gruposPlan as $grupo)
                                    <option value="{{ $grupo }}" {{ old('grupo_plan') == $grupo ? 'selected' : '' }}>
                                        {{ $grupo }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Opcional: limite el análisis a un grupo.</small>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-3">
                            <label for="linea">
                                <i class="fas fa-tags text-primary mr-1"></i>
                                Línea
                            </label>
                            <select name="linea" id="linea" class="form-control select2">
                                <option value="">Todas las líneas</option>
                                @foreach ($lineas as $linea)
                                    <option value="{{ $linea }}" {{ old('linea') == $linea ? 'selected' : '' }}>
                                        {{ $linea }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Opcional: analice una familia de productos.</small>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-3">
                            <label for="temporada">
                                <i class="fas fa-clock text-primary mr-1"></i>
                                Temporada
                            </label>
                            <select name="temporada" id="temporada" class="form-control select2">
                                <option value="">Todas las temporadas</option>
                                @foreach ($temporadas as $temporada)
                                    <option value="{{ $temporada }}" {{ old('temporada') == $temporada ? 'selected' : '' }}>
                                        {{ $temporada }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Opcional: enfoque el resultado por temporada.</small>
                        </div>
                    </div>

                    <div class="sm-toolbar mt-1 rounded border">
                        <div class="sm-toolbar__meta">
                            <i class="fas fa-info-circle text-primary mr-1"></i>
                            El motor evalúa venta, stock disponible y restricciones activas antes de proponer transferencias.
                        </div>

                        <div class="sm-toolbar__actions">
                            <button type="button" class="btn btn-light" id="limpiarFiltros">
                                <i class="fas fa-eraser"></i>
                                Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary px-4" id="btnAnalizar">
                                <i class="fas fa-play"></i>
                                Ejecutar análisis
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card sm-data-card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h3 class="card-title mb-0">
                        <i class="fas fa-project-diagram text-primary mr-2"></i>
                        Sugerencias de redistribución
                    </h3>
                    <small class="text-muted">Movimientos recomendados de acuerdo con demanda y disponibilidad.</small>
                </div>

                <span class="badge badge-light mt-2 mt-md-0">
                    <i class="fas fa-database mr-1"></i>
                    Resultados del análisis
                </span>
            </div>

            <div class="card-body p-0">
                @include('redistribucion_sugeridas.table')
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                allowClear: true,
                placeholder: function() {
                    return $(this).find('option:first').text();
                }
            });

            $('#limpiarFiltros').on('click', function() {
                $('#periodo').val('').trigger('change');
                $('#grupo_plan').val('').trigger('change');
                $('#linea').val('').trigger('change');
                $('#temporada').val('').trigger('change');
            });

            $('#formAnalisis').on('submit', function() {
                const periodo = $('#periodo').val();

                if (!periodo) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Período requerido',
                        text: 'Debe seleccionar un período para ejecutar el análisis.',
                        confirmButtonText: 'Entendido'
                    });
                    return false;
                }

                const btn = $('#btnAnalizar');
                btn.prop('disabled', true);
                btn.html('<i class="fas fa-spinner fa-spin"></i> Analizando...');
            });
        });
    </script>
@endpush
