<div class="table-responsive">
    <table class="table table-hover" id="redistribucion-configs-table">
        <thead>
            <tr>
                <th>Método demanda</th>
                <th class="text-right">% demanda</th>
                <th class="text-right">Stock mín.</th>
                <th class="text-right">Stock máx.</th>
                <th class="text-right">Venta mín.</th>
                <th class="text-right">% necesidad</th>
                <th class="text-right">% conservar origen</th>
                <th class="text-right">Cantidad mín.</th>
                <th class="text-right">Cantidad máx.</th>
                <th class="text-right">Días bloqueo</th>
                <th>Pendientes</th>
                <th>En proceso</th>
                <th>Finalizados recientes</th>
                <th>Activo</th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($redistribucionConfigs as $redistribucionConfig)
                <tr>
                    <td>{{ $redistribucionConfig->metodo_demanda }}</td>
                    <td class="text-right">{{ $redistribucionConfig->porcentaje_demanda }}</td>
                    <td class="text-right">{{ $redistribucionConfig->stock_minimo }}</td>
                    <td class="text-right">{{ $redistribucionConfig->stock_maximo }}</td>
                    <td class="text-right">{{ $redistribucionConfig->venta_minima }}</td>
                    <td class="text-right">{{ $redistribucionConfig->porcentaje_necesidad }}</td>
                    <td class="text-right">{{ $redistribucionConfig->porcentaje_conservar_origen }}</td>
                    <td class="text-right">{{ $redistribucionConfig->cantidad_minima }}</td>
                    <td class="text-right">{{ $redistribucionConfig->cantidad_maxima }}</td>
                    <td class="text-right">{{ $redistribucionConfig->dias_bloqueo }}</td>
                    <td>
                        <span class="badge {{ $redistribucionConfig->bloquear_pendientes ? 'badge-warning' : 'badge-light' }}">
                            {{ $redistribucionConfig->bloquear_pendientes ? 'Sí' : 'No' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $redistribucionConfig->bloquear_en_proceso ? 'badge-warning' : 'badge-light' }}">
                            {{ $redistribucionConfig->bloquear_en_proceso ? 'Sí' : 'No' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $redistribucionConfig->bloquear_finalizados_recientes ? 'badge-warning' : 'badge-light' }}">
                            {{ $redistribucionConfig->bloquear_finalizados_recientes ? 'Sí' : 'No' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $redistribucionConfig->activo ? 'badge-success' : 'badge-light' }}">
                            {{ $redistribucionConfig->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="text-right">
                        {!! Form::open([
                            'route' => ['redistribucion-configs.destroy', $redistribucionConfig->id],
                            'method' => 'delete',
                            'class' => 'd-inline',
                        ]) !!}
                            <div class="d-inline-flex">
                                <a href="{{ route('redistribucion-configs.show', $redistribucionConfig->id) }}"
                                    class="btn btn-default sm-icon-button mr-1" title="Ver">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{ route('redistribucion-configs.edit', $redistribucionConfig->id) }}"
                                    class="btn btn-primary sm-icon-button mr-1" title="Editar">
                                    <i class="far fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'button',
                                    'class' => 'btn btn-danger sm-icon-button alert-delete',
                                    'data-mensaje' => 'esta configuración',
                                    'title' => 'Eliminar',
                                ]) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center text-muted py-4">
                        No hay configuraciones registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card-footer clearfix">
    <div class="float-right">
        @include('adminlte-templates::common.paginate', ['records' => $redistribucionConfigs])
    </div>
</div>
