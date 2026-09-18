<div class="table-responsive">
    <table class="table table-hover" id="carga_fotos-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>N° OT</th>
                <th class="text-right">Costo</th>
                <th class="text-right">Venta</th>
                <th>Artículo</th>
                <th>Imagen</th>
                <th>Usuario</th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fotos as $value)
                <tr>
                    <td>{{ CarbonCarbon::parse($value->fot_fecha)->format('d/m/Y') }}</td>
                    <td><strong>{{ $value->fot_ot }}</strong></td>
                    <td class="text-right">{{ number_format($value->fot_costo, 0, ',', '.') }} Gs.</td>
                    <td class="text-right">{{ number_format($value->fot_venta, 0, ',', '.') }} Gs.</td>
                    <td>{{ $value->fot_desc }} {{ $value->linea->linea_desc ?? $value->linea_cod }}</td>
                    <td>
                        @if ($value->fot_img)
                            <img
                                src="{{ Storage::url('fotos/' . $value->fot_img) }}"
                                alt="Imagen OT {{ $value->fot_ot }}"
                                class="sm-photo-thumb">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    <td>{{ $value->user->name ?? $value->user_id }}</td>
                    <td class="text-right">
                        <div class="d-inline-flex align-items-center">
                            <a href="{{ route('carga_fotos.show', [$value->fot_cod]) }}"
                                class="btn btn-default sm-icon-button mr-1" title="Ver">
                                <i class="far fa-eye"></i>
                            </a>

                            @can('carga_fotos edit')
                                <a href="{{ route('carga_fotos.edit', [$value->fot_cod]) }}"
                                    class="btn btn-primary sm-icon-button mr-1" title="Editar">
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan

                            @can('carga_fotos destroy')
                                {!! Form::open([
                                    'route' => ['carga_fotos.destroy', $value->fot_cod],
                                    'method' => 'delete',
                                    'class' => 'd-inline',
                                ]) !!}
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'button',
                                    'class' => 'btn btn-danger sm-icon-button alert-delete',
                                    'data-mensaje' => $value->fot_ot,
                                    'title' => 'Eliminar',
                                ]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        No se encontraron resultados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card-footer clearfix">
    <div class="float-left text-muted">
        Mostrando {{ $fotos->firstItem() ?? 0 }} - {{ $fotos->lastItem() ?? 0 }}
        de {{ $fotos->total() }} registros
    </div>
    <div class="float-right">
        {{ $fotos->links() }}
    </div>
</div>
