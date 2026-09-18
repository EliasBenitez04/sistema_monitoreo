{{-- ==========================================================
     ESTILOS DE LA TABLA
========================================================== --}}




{{-- ==========================================================
     TABLA
========================================================== --}}

<div class="card-body p-0 clientes-table-card">

    <div class="table-responsive">

        <table class="table table-hover table-striped mb-0" id="clientes-table">

            <thead class="text-center">

                <tr>

                    <th style="width: 55px;">
                        #
                    </th>

                    <th style="width: 130px;">
                        Nro. Documento
                    </th>

                    <th style="width: 230px;">
                        Cliente
                    </th>

                    <th style="min-width: 220px;">
                        Dirección
                    </th>

                    <th style="width: 130px;">
                        Teléfono
                    </th>

                    <th style="width: 150px;">
                        Departamento
                    </th>

                    <th style="width: 150px;">
                        Ciudad
                    </th>

                    <th style="width: 110px;">
                        Operaciones
                    </th>

                </tr>

            </thead>


            <tbody>

                @foreach ($clientes as $cliente)
                    <tr>

                        {{-- ID --}}
                        <td class="text-center">

                            <span class="cliente-id">
                                {{ $cliente->id_cliente }}
                            </span>

                        </td>


                        {{-- DOCUMENTO --}}
                        <td class="text-center">

                            <span class="cliente-documento">

                                <i class="fas fa-id-card"></i>

                                {{ $cliente->cli_ci }}

                            </span>

                        </td>


                        {{-- CLIENTE --}}
                        <td>

                            <div class="cliente-nombre">

                                <i class="fas fa-user"></i>

                                {{ $cliente->cli_nombre }}

                                @if ($cliente->cli_apellido)
                                    {{ $cliente->cli_apellido }}
                                @endif

                            </div>

                        </td>


                        {{-- DIRECCIÓN --}}
                        <td>

                            <div class="cliente-direccion">

                                @if ($cliente->cli_direccion)
                                    <i class="fas fa-map-marker-alt"></i>

                                    {{ $cliente->cli_direccion }}
                                @else
                                    <span class="text-muted">
                                        Sin dirección
                                    </span>
                                @endif

                            </div>

                        </td>


                        {{-- TELÉFONO --}}
                        <td class="text-center">

                            @if ($cliente->cli_telefono)
                                <span class="cliente-telefono">

                                    <i class="fas fa-phone"></i>

                                    {{ $cliente->cli_telefono }}

                                </span>
                            @else
                                <span class="text-muted">
                                    —
                                </span>
                            @endif

                        </td>


                        {{-- DEPARTAMENTO --}}
                        <td class="text-center">

                            <span class="cliente-ubicacion">

                                <i class="fas fa-map"></i>

                                {{ $cliente->dep_descripcion ?? '—' }}

                            </span>

                        </td>


                        {{-- CIUDAD --}}
                        <td class="text-center">

                            <span class="cliente-ubicacion">

                                <i class="fas fa-city"></i>

                                {{ $cliente->ciu_descripcion ?? '—' }}

                            </span>

                        </td>


                        {{-- OPERACIONES --}}
                        <td>

                            {!! Form::open([
                                'route' => ['clientes.destroy', $cliente->id_cliente],
                                'method' => 'delete',
                            ]) !!}

                            <div class="cliente-actions">

                                @can('clientes edit')
                                    <a href="{{ route('clientes.edit', [$cliente->id_cliente]) }}" class="btn btn-primary"
                                        data-toggle="tooltip" title="Editar cliente">

                                        <i class="far fa-edit"></i>

                                    </a>
                                @endcan


                                @can('clientes destroy')
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger alert-delete',
                                        'data-toggle' => 'tooltip',
                                        'title' => 'Eliminar cliente',
                                    ]) !!}
                                @endcan

                            </div>

                            {!! Form::close() !!}

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>


    {{-- ==========================================================
         FOOTER / PAGINACIÓN
    =========================================================== --}}

    <div class="clientes-footer clearfix">

        <div class="float-left clientes-footer-info">

            Mostrando

            <strong>
                {{ $clientes->firstItem() ?? 0 }}
            </strong>

            -

            <strong>
                {{ $clientes->lastItem() ?? 0 }}
            </strong>

            de

            <strong>
                {{ $clientes->total() }}
            </strong>

            registros

        </div>


        <div class="float-right clientes-pagination">

            {{ $clientes->links() }}

        </div>

    </div>

</div>

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/clientes-table.css') }}?v=20260918-2">
@endpush
