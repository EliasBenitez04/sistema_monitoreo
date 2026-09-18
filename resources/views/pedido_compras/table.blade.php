{{-- =========================================================
    TABLA PEDIDOS - DISEÑO ENTERPRISE
========================================================= --}}

<div class="enterprise-table-card">

    {{-- HEADER --}}
    <div class="enterprise-table-header">

        <div class="enterprise-title">

            <div class="enterprise-title-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>

            <div>
                <h3>Pedidos de mayoristas</h3>
                <span>Gestión y seguimiento de pedidos registrados</span>
            </div>

        </div>

        <div class="enterprise-summary">

            <div class="summary-item">
                <span>Total</span>
                <strong>{{ $pedido_compras->total() }}</strong>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('pedido_compras.create') }}" class="btn btn-primary float-right shadow-sm px-4 py-2"
                    style="border-radius: 8px; font-weight: 600;">
                    Nuevo Pedido
                </a>
            </div>

        </div>

    </div>


    {{-- TABLA --}}
    <div class="enterprise-table-wrapper">

        <table id="pedido_compras-table" class="enterprise-table">

            <thead>

                <tr>

                    <th class="sortable">
                        <span>Nro. Pedido</span>
                    </th>

                    <th class="sortable">
                        <span>Fecha</span>
                    </th>

                    <th class="sortable">
                        <span>Cliente</span>
                    </th>

                    <th class="sortable text-center">
                        <span>Artículos</span>
                    </th>

                    <th class="sortable text-right">
                        <span>Total</span>
                    </th>

                    <th class="sortable">
                        <span>Responsable</span>
                    </th>

                    <th class="sortable text-center">
                        <span>Estado</span>
                    </th>

                    <th>
                        <span>Observación</span>
                    </th>

                    <th class="text-center action-column">
                        <span>Acciones</span>
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($pedido_compras as $pedido)
                    <tr>

                        {{-- PEDIDO --}}
                        <td>

                            <div class="order-number">

                                <div class="order-icon">
                                    <i class="fas fa-file-invoice"></i>
                                </div>

                                <div>
                                    <strong>
                                        #{{ $pedido->nro_pedido }}
                                    </strong>

                                    <small>
                                        ID {{ $pedido->id_pedido }}
                                    </small>
                                </div>

                            </div>

                        </td>


                        {{-- FECHA --}}
                        <td>
                            <div class="date-cell">
                                <strong>
                                    {{ \Carbon\Carbon::parse($pedido->ped_fecha)->format('d/m/Y') }}
                                </strong>
                            </div>
                        </td>


                        {{-- CLIENTE --}}
                        <td>

                            <div class="client-cell">

                                <div class="client-avatar">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div>

                                    <strong>
                                        {{ $pedido->cliente }}
                                    </strong>

                                    <small>
                                        Cliente
                                    </small>

                                </div>

                            </div>

                        </td>


                        {{-- CANTIDAD --}}
                        <td class="text-center">

                            <span class="quantity-badge">

                                <i class="fas fa-boxes"></i>

                                {{ number_format($pedido->total_cantidad, 0, ',', '.') }}

                            </span>

                        </td>


                        {{-- TOTAL --}}
                        <td class="text-right">

                            <div class="amount-cell">

                                <small>Gs.</small>

                                <strong>
                                    {{ number_format($pedido->ped_total, 0, ',', '.') }}
                                </strong>

                            </div>

                        </td>


                        {{-- USUARIO --}}
                        <td>

                            <div class="user-cell">

                                <div class="user-avatar">
                                    <i class="fas fa-user-tie"></i>
                                </div>

                                <span>
                                    {{ $pedido->usuario }}
                                </span>

                            </div>

                        </td>


                        {{-- ESTADO --}}
                        <td class="text-center">

                            @if ($pedido->ped_estado === 'CONFIRMADO')
                                <span class="enterprise-status status-success">
                                    <span></span>
                                    Confirmado
                                </span>
                            @elseif ($pedido->ped_estado === 'ANULADO')
                                <span class="enterprise-status status-danger">
                                    <span></span>
                                    Anulado
                                </span>
                            @else
                                <span class="enterprise-status status-warning">
                                    <span></span>
                                    Pendiente
                                </span>
                            @endif

                        </td>


                        {{-- OBS --}}
                        <td>

                            @if ($pedido->obs)
                                <div class="observation-cell" title="{{ $pedido->obs }}">

                                    <i class="fas fa-comment-alt"></i>

                                    <span>
                                        {{ \Illuminate\Support\Str::limit($pedido->obs, 35) }}
                                    </span>

                                </div>
                            @else
                                <span class="no-observation">
                                    Sin observación
                                </span>
                            @endif

                        </td>


                        {{-- ACCIONES --}}
                        <td class="text-center">

                            <div class="enterprise-actions">


                                {{-- CONFIRMAR --}}
                                @if ($pedido->ped_estado === 'PENDIENTE')
                                    {!! Form::open([
                                        'route' => ['pedido_compras.confirm', $pedido->id_pedido],
                                        'method' => 'patch',
                                        'id' => 'confirm-form-' . $pedido->id_pedido,
                                        'class' => 'd-inline',
                                    ]) !!}

                                    {!! Form::button('<i class="fas fa-check"></i>', [
                                        'type' => 'button',
                                        'class' => 'action-btn action-confirm alert-confirm',
                                        'data-id' => $pedido->id_pedido,
                                        'title' => 'Confirmar pedido',
                                    ]) !!}

                                    {!! Form::close() !!}
                                @endif


                                {{-- IMPRIMIR --}}
                                @if ($pedido->ped_estado === 'CONFIRMADO')
                                    <a href="{{ route('pedido_compras.imprimir', [$pedido->id_pedido]) }}"
                                        class="action-btn action-print" title="Imprimir pedido">

                                        <i class="fas fa-print"></i>

                                    </a>


                                    {{-- EXCEL --}}
                                    <a href="{{ route('pedido.export', [$pedido->id_pedido]) }}"
                                        class="action-btn action-excel" title="Exportar Excel">

                                        <i class="fas fa-file-excel"></i>

                                    </a>
                                @endif


                                {{-- EDITAR --}}
                                @if (!in_array(trim($pedido->ped_estado), ['CONFIRMADO', 'ANULADO']))
                                    <a href="{{ route('pedido_compras.edit', [$pedido->id_pedido]) }}"
                                        class="action-btn action-edit" title="Editar pedido">

                                        <i class="fas fa-pen"></i>

                                    </a>
                                @endif


                                {{-- VER --}}
                                <a href="{{ route('pedido_compras.show', [$pedido->id_pedido]) }}"
                                    class="action-btn action-view" title="Ver detalles">

                                    <i class="fas fa-eye"></i>

                                </a>


                                {{-- ANULAR --}}
                                @if ($pedido->ped_estado !== 'ANULADO')
                                    {!! Form::open([
                                        'route' => ['pedido_compras.destroy', $pedido->id_pedido],
                                        'method' => 'delete',
                                        'class' => 'd-inline',
                                        'id' => 'delete-form-' . $pedido->id_pedido,
                                    ]) !!}

                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                        'type' => 'button',
                                        'class' => 'action-btn action-delete alert-delete',
                                        'data-id' => $pedido->id_pedido,
                                        'title' => 'Anular pedido',
                                    ]) !!}

                                    {!! Form::close() !!}
                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9">

                            <div class="enterprise-empty">

                                <div class="empty-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>

                                <h4>No hay pedidos registrados</h4>

                                <p>
                                    No se encontraron pedidos para mostrar.
                                </p>

                            </div>

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}
    @if ($pedido_compras->total() > 0)
        <div class="enterprise-table-footer">

            <div class="records-info">

                <i class="fas fa-database"></i>

                <span>
                    Mostrando
                    <strong>{{ $pedido_compras->firstItem() }}</strong>
                    -
                    <strong>{{ $pedido_compras->lastItem() }}</strong>
                    de
                    <strong>{{ $pedido_compras->total() }}</strong>
                    registros
                </span>

            </div>

            <div class="enterprise-pagination">

                {{ $pedido_compras->links() }}

            </div>

        </div>
    @endif

</div>


{{-- =========================================================
    CSS ENTERPRISE
========================================================= --}}




{{-- =========================================================
    ORDENAMIENTO
========================================================= --}}

@push('page_scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const table = document.getElementById("pedido_compras-table");

        if (!table) return;

        const headers = table.querySelectorAll(
            "thead th.sortable"
        );

        let currentSort = {
            index: null,
            direction: "asc"
        };


        function toNumber(value) {

            return parseFloat(

                (value || "")
                .toString()
                .replace(/[^\d,.-]/g, "")
                .replace(/\./g, "")
                .replace(",", ".")

            ) || 0;

        }


        function toDate(value) {

            if (!value) return 0;

            const parts = value.split("/");

            if (parts.length !== 3) return 0;

            return new Date(
                parts[2],
                parts[1] - 1,
                parts[0]
            ).getTime();

        }


        headers.forEach(function(th, index) {

            const icon = document.createElement("span");

            icon.className = "sort-indicator";

            icon.innerHTML = "↕";

            icon.style.marginLeft = "6px";

            icon.style.opacity = ".5";

            th.appendChild(icon);


            th.addEventListener("click", function() {

                if (currentSort.index === index) {

                    currentSort.direction =
                        currentSort.direction === "asc" ?
                        "desc" :
                        "asc";

                } else {

                    currentSort.index = index;

                    currentSort.direction = "asc";

                }


                sortTable(
                    index,
                    currentSort.direction
                );


                updateIcons(
                    index,
                    currentSort.direction
                );

            });

        });


        function sortTable(columnIndex, direction) {

            const tbody = table.querySelector("tbody");

            const rows = Array.from(
                tbody.querySelectorAll("tr")
            );


            rows.sort(function(a, b) {

                let aText =
                    a.children[columnIndex]?.innerText.trim() || "";

                let bText =
                    b.children[columnIndex]?.innerText.trim() || "";


                /* FECHA */

                if (columnIndex === 1) {

                    aText = toDate(aText);

                    bText = toDate(bText);

                }


                /* NUMEROS */
                else if (
                    columnIndex === 3 ||
                    columnIndex === 4
                ) {

                    aText = toNumber(aText);

                    bText = toNumber(bText);

                } else {

                    aText = aText.toLowerCase();

                    bText = bText.toLowerCase();

                }


                if (aText < bText)
                    return direction === "asc" ? -1 : 1;


                if (aText > bText)
                    return direction === "asc" ? 1 : -1;


                return 0;

            });


            rows.forEach(function(row) {

                tbody.appendChild(row);

            });

        }


        function updateIcons(activeIndex, direction) {

            headers.forEach(function(th, index) {

                const icon =
                    th.querySelector(".sort-indicator");

                if (!icon) return;


                if (index === activeIndex) {

                    icon.innerHTML =
                        direction === "asc" ?
                        "▲" :
                        "▼";

                    icon.style.opacity = "1";

                } else {

                    icon.innerHTML = "↕";

                    icon.style.opacity = ".5";

                }

            });

        }

    });
</script>
@endpush

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/pedido-table.css') }}?v=20260918-2">
@endpush
