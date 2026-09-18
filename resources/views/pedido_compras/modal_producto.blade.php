<!-- =========================================================
     MODAL BUSCAR PRODUCTOS PEDIDOS
========================================================= -->
<div class="modal fade" id="productSearchModalPed" tabindex="-1" role="dialog" aria-labelledby="productSearchModalPedLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl" role="document">

        <div class="modal-content shadow-lg border-0">

            <!-- =====================================================
                 HEADER
            ====================================================== -->
            <div class="modal-header modal-productos-header">

                <div class="d-flex align-items-center">

                    <div class="modal-header-icon">
                        <i class="fas fa-search"></i>
                    </div>

                    <div>
                        <h5 class="modal-title font-weight-bold mb-0" id="productSearchModalPedLabel">

                            Buscar Productos

                        </h5>

                        <small>
                            Seleccione un producto para agregar al pedido
                        </small>
                    </div>

                </div>

                <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <!-- =====================================================
                 BODY
            ====================================================== -->
            <div class="modal-body modal-productos-body">

                <div class="row">

                    <!-- =================================================
                         COLUMNA IZQUIERDA
                    ================================================== -->
                    <div class="col-md-8">

                        <!-- BUSCADOR -->
                        <div class="card buscador-card border-0 shadow-sm mb-3">

                            <div class="card-body p-3">

                                <label class="buscador-label mb-2">
                                    <i class="fas fa-search mr-1"></i>
                                    Buscar producto
                                </label>

                                <div class="input-group input-group-lg buscador-input">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text">

                                            <i class="fas fa-search"></i>

                                        </span>

                                    </div>

                                    <input type="text" id="productSearchQueryPed" class="form-control"
                                        placeholder="Buscar por código o descripción..." autocomplete="off">

                                </div>

                                <small class="text-muted buscador-ayuda">

                                    Escriba al menos 4 caracteres para realizar la búsqueda.

                                </small>

                            </div>

                        </div>


                        <!-- =================================================
                             TABLA PRODUCTOS
                        ================================================== -->
                        <div class="card productos-card border-0 shadow-sm">

                            <div class="card-header productos-card-header">

                                <div class="d-flex align-items-center">

                                    <div class="productos-header-icon">
                                        <i class="fas fa-boxes"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            Productos disponibles
                                        </strong>

                                        <small class="d-block text-muted">
                                            Seleccione el producto que desea agregar
                                        </small>

                                    </div>

                                </div>

                            </div>

                            <div class="card-body p-0">

                                <div id="modalResultsPed" class="table-responsive">

                                    <table class="table table-hover table-striped mb-0">

                                        <thead class="bg-dark text-white">
                                        </thead>

                                        <tbody>

                                            @include('pedido_compras.buscar_producto')

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         COLUMNA DERECHA
                    ================================================== -->
                    <div class="col-md-4">

                        <div class="card border-0 shadow-sm resumen-pedido-card">

                            <!-- HEADER RESUMEN -->
                            <div class="resumen-header">

                                <div class="d-flex align-items-center">

                                    <div class="resumen-header-icon">

                                        <i class="fas fa-shopping-cart"></i>

                                    </div>

                                    <div>

                                        <h5 class="mb-0 font-weight-bold">
                                            Resumen del pedido
                                        </h5>

                                        <small>
                                            Configure la cantidad antes de agregar
                                        </small>

                                    </div>

                                </div>

                            </div>


                            <div class="card-body p-3">


                                <!-- =================================================
                                     CANTIDAD DE INSERCIÓN
                                ================================================== -->
                                <div class="cantidad-insercion-box">

                                    <div class="cantidad-insercion-header">

                                        <div>

                                            <span class="cantidad-insercion-label">

                                                <i class="fas fa-layer-group mr-1"></i>

                                                Cantidad de inserción

                                            </span>

                                            <small class="d-block text-muted mt-1">

                                                Cantidad que se agregará por producto.

                                            </small>

                                        </div>

                                        <span class="badge badge-primary cantidad-badge">

                                            <i class="fas fa-bolt mr-1"></i>

                                            Rápido

                                        </span>

                                    </div>


                                    <!-- CONTROL CANTIDAD -->
                                    <div class="cantidad-input-wrapper">

                                        <button type="button" class="btn cantidad-btn"
                                            onclick="cambiarCantidadInsercion(-1)">

                                            <i class="fas fa-minus"></i>

                                        </button>


                                        <input type="number" id="cantidad_multiplicador"
                                            class="cantidad-insercion-input" value="1" min="1"
                                            autocomplete="off">


                                        <button type="button" class="btn cantidad-btn"
                                            onclick="cambiarCantidadInsercion(1)">

                                            <i class="fas fa-plus"></i>

                                        </button>

                                    </div>


                                    <div class="cantidad-info">

                                        <i class="fas fa-info-circle"></i>

                                        <span>
                                            Esta cantidad se aplicará al producto seleccionado.
                                        </span>

                                    </div>

                                </div>


                                <!-- =================================================
                                     INDICADORES
                                ================================================== -->
                                <div class="row mt-3">

                                    <!-- PRODUCTOS -->
                                    <div class="col-6 pr-1">

                                        <div class="resumen-stat productos-stat">

                                            <div class="resumen-stat-icon">

                                                <i class="fas fa-boxes"></i>

                                            </div>

                                            <div class="resumen-stat-info">

                                                <span>
                                                    Productos
                                                </span>

                                                <strong id="modalCantidadProductos">
                                                    0
                                                </strong>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- TOTAL -->
                                    <div class="col-6 pl-1">

                                        <div class="resumen-stat total-stat">

                                            <div class="resumen-stat-icon">

                                                <i class="fas fa-dollar-sign"></i>

                                            </div>

                                            <div class="resumen-stat-info">

                                                <span>
                                                    Total
                                                </span>

                                                <strong id="modalTotalPedido">
                                                    0
                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <!-- =================================================
                                     AYUDA
                                ================================================== -->
                                <div class="resumen-ayuda mt-3">

                                    <div class="resumen-ayuda-icon">

                                        <i class="fas fa-lightbulb"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Consejo
                                        </strong>

                                        <span>
                                            Ajuste la cantidad antes de seleccionar
                                            el producto para cargarla automáticamente.
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     ESTILOS
========================================================= -->



@push('page_scripts')
    <script>
        /* =========================================================
           BUSCADOR DE PRODUCTOS
        ========================================================= */

        document.getElementById('productSearchQueryPed')
            .addEventListener('keyup', function() {

                let query = this.value;

                fetch(
                        '{{ url('buscar-productos-ped') }}?query=' +
                        encodeURIComponent(query) +
                        '&cod_suc=' +
                        $("#cod_suc").val()
                    )

                    .then(response => response.text())

                    .then(html => {

                        document.getElementById('modalResultsPed').innerHTML = html;

                    });

            });


        /* =========================================================
           CANTIDAD DE INSERCIÓN
        ========================================================= */

        function cambiarCantidadInsercion(valor) {

            const input = document.getElementById(
                'cantidad_multiplicador'
            );

            if (!input) return;

            let cantidad = parseInt(input.value) || 1;

            cantidad += valor;

            if (cantidad < 1) {

                cantidad = 1;

            }

            input.value = cantidad;

        }


        $('#cantidad_multiplicador').on('change', function() {

            let cantidad = parseInt(this.value) || 1;

            if (cantidad < 1) {

                cantidad = 1;

            }

            this.value = cantidad;

        });


        /* =========================================================
           SELECCIONAR PRODUCTO
        ========================================================= */

        function seleccionarProductoPed(
            codigo,
            producto,
            stock,
            precio
        ) {

            let tabla = document.getElementById(
                'selectedProducts'
            );

            if (!tabla) return;


            /* -----------------------------------------------------
               CANTIDAD DE INSERCIÓN
            ----------------------------------------------------- */

            let cantidadMultiplicador =
                parseInt(
                    document.getElementById(
                        "cantidad_multiplicador"
                    ).value
                ) || 1;


            /* -----------------------------------------------------
               EVITAR DUPLICADOS
            ----------------------------------------------------- */

            let filas =
                tabla.getElementsByTagName('tr');

            for (
                let i = 0; i < filas.length; i++
            ) {

                let inputCodigo =
                    filas[i].querySelector(
                        'input[name="codigo[]"]'
                    );

                if (
                    inputCodigo &&
                    inputCodigo.value === codigo
                ) {

                    alert(
                        'El producto ya fue agregado.'
                    );

                    return;

                }

            }


            /* -----------------------------------------------------
               CALCULAR SUBTOTAL
            ----------------------------------------------------- */

            let subtotal =
                precio * cantidadMultiplicador;


            /* -----------------------------------------------------
               CREAR FILA
            ----------------------------------------------------- */

            let row =
                document.createElement('tr');


            row.innerHTML = `

            <td class="text-center">

                <input
                    type="text"
                    name="codigo[]"
                    class="form-control text-center"
                    value="${codigo}"
                    readonly
                >

            </td>


            <td>

                <input
                    type="text"
                    name="producto[]"
                    class="form-control"
                    value="${producto}"
                    readonly
                >

            </td>


            <td>

                <input
                    type="number"
                    name="cantidad[]"
                    class="form-control text-center cantidad"
                    value="${cantidadMultiplicador}"
                    min="1"
                    max="${stock}"
                >

            </td>


            <td class="text-center">

                <input
                    type="number"
                    name="precio[]"
                    class="form-control text-center precio"
                    value="${precio}"
                >

            </td>


            <td class="text-center">

                <input
                    type="text"
                    name="subtotal[]"
                    class="form-control text-center subtotal"
                    value="${subtotal}"
                    readonly
                >

            </td>


            <td class="text-center">

                <button
                    type="button"
                    class="btn btn-danger"
                    onclick="borrarFila(this)"
                >

                    <i class="far fa-trash-alt"></i>

                </button>

            </td>

        `;


            tabla.appendChild(row);


            /* -----------------------------------------------------
               CERRAR MODAL
            ----------------------------------------------------- */

            $('#productSearchModalPed').modal('hide');


            /* -----------------------------------------------------
               RECALCULAR
            ----------------------------------------------------- */

            calcularTodo();

        }


        /* =========================================================
           RECALCULAR SUBTOTAL
        ========================================================= */

        $(document).on(
            "keyup change",
            ".cantidad, .precio",
            function() {

                let fila =
                    $(this).closest("tr");

                let cant =
                    parseFloat(
                        fila.find(".cantidad").val()
                    ) || 0;

                let precio =
                    parseFloat(
                        fila.find(".precio").val()
                    ) || 0;

                let subtotal =
                    cant * precio;

                fila.find(".subtotal")
                    .val(subtotal);

                calcularTotal();

            }
        );


        /* =========================================================
           CALCULAR TOTAL
        ========================================================= */

        function calcularTotal() {

            let total = 0;

            $(".subtotal").each(function() {

                total +=
                    parseFloat(
                        $(this).val()
                    ) || 0;

            });

            $("#ped_total").val(
                total.toLocaleString('es-PY')
            );

        }


        /* =========================================================
           BORRAR FILA
        ========================================================= */

        function borrarFila(btn) {

            let fila =
                btn.closest('tr');

            if (fila) {

                fila.remove();

            }

            calcularTodo();

        }


        /* =========================================================
           BORRAR PEDIDO
        ========================================================= */

        function borrarPed(button) {

            let row =
                button.closest('tr');

            if (row) {

                row.remove();

            }

            calcularTodo();

        }
    </script>
@endpush

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/pedido-modal-producto.css') }}?v=20260918-2">
@endpush
