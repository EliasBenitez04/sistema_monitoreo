<!-- ========================================================= -->
<!-- MODAL NUEVO CLIENTE - DISEÑO EMPRESARIAL -->
<!-- ========================================================= -->




<!-- ========================================================= -->
<!-- MODAL -->
<!-- ========================================================= -->

<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="modalClienteLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">


            <!-- ================================================= -->
            <!-- HEADER -->
            <!-- ================================================= -->

            <div class="modal-header">

                <div class="modal-header-content">

                    <div class="modal-header-icon">

                        <i class="fas fa-user-plus"></i>

                    </div>

                    <div>

                        <div class="modal-title" id="modalClienteLabel">

                            Nuevo Cliente

                        </div>

                        <div class="modal-subtitle">

                            Registre los datos del cliente

                        </div>

                    </div>

                </div>


                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">

                    <span aria-hidden="true">
                        &times;
                    </span>

                </button>

            </div>


            <!-- ================================================= -->
            <!-- FORMULARIO -->
            <!-- ================================================= -->

            <form method="POST" action="{{ route('clientes.store') }}" id="form-cliente-modal">

                @csrf


                <!-- ================================================= -->
                <!-- BODY -->
                <!-- ================================================= -->

                <div class="modal-body">


                    <!-- ============================================= -->
                    <!-- INFORMACIÓN PERSONAL -->
                    <!-- ============================================= -->

                    <div class="form-section">

                        <div class="section-title">

                            <i class="fas fa-user"></i>

                            Información personal

                        </div>


                        <div class="row">


                            <!-- CI -->
                            <div class="form-group col-md-4">

                                <label for="modal_cli_ci">

                                    C.I. / R.U.C.

                                    <span class="required">*</span>

                                </label>


                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text">

                                            <i class="fas fa-id-card"></i>

                                        </span>

                                    </div>


                                    <input type="text" name="cli_ci" id="modal_cli_ci" class="form-control"
                                        placeholder="Ej. 1234567" autocomplete="off" required>

                                </div>

                            </div>


                            <!-- NOMBRE -->
                            <div class="form-group col-md-4">
                                <label for="modal_cli_nombre">
                                    Nombre
                                    <span class="required">*</span>
                                </label>

                                <input type="text" name="cli_nombre" id="modal_cli_nombre" class="form-control"
                                    placeholder="Ingrese el nombre" autocomplete="off" required>
                            </div>
                            <!-- APELLIDO -->
                            <div class="form-group col-md-4">
                                <label for="modal_cli_apellido">
                                    Apellido
                                </label>
                                <input type="text" name="cli_apellido" id="modal_cli_apellido" class="form-control"
                                    placeholder="Ingrese el apellido" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <!-- ============================================= -->
                    <!-- INFORMACIÓN DE CONTACTO -->
                    <!-- ============================================= -->

                    <div class="form-section">

                        <div class="section-title">

                            <i class="fas fa-address-book"></i>

                            Información de contacto

                        </div>


                        <div class="row">


                            <!-- DIRECCIÓN -->
                            <div class="form-group col-md-8">

                                <label for="modal_cli_direccion">

                                    Dirección

                                    <span class="required">*</span>

                                </label>


                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text">

                                            <i class="fas fa-map-marker-alt"></i>

                                        </span>

                                    </div>


                                    <input type="text" name="cli_direccion" id="modal_cli_direccion"
                                        class="form-control" placeholder="Ingrese la dirección" autocomplete="off"
                                        required>

                                </div>

                            </div>


                            <!-- TELÉFONO -->
                            <div class="form-group col-md-4">

                                <label for="modal_cli_telefono">

                                    Teléfono

                                    <span class="required">*</span>

                                </label>


                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text">

                                            <i class="fas fa-phone"></i>

                                        </span>

                                    </div>


                                    <input type="text" name="cli_telefono" id="modal_cli_telefono"
                                        class="form-control" placeholder="Ej. 0981..." autocomplete="off" required>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ============================================= -->
                    <!-- UBICACIÓN -->
                    <!-- ============================================= -->

                    <div class="form-section">

                        <div class="section-title">

                            <i class="fas fa-map-marked-alt"></i>

                            Ubicación

                        </div>


                        <div class="row">


                            <!-- DEPARTAMENTO -->
                            <div class="form-group col-md-6">

                                <label for="modal_id_departamento">

                                    Departamento

                                    <span class="required">*</span>

                                </label>


                                <select name="id_departamento" id="modal_id_departamento" class="form-control select2"
                                    style="width: 100%;" required>

                                    <option value="">
                                        Seleccione departamento...
                                    </option>


                                    @foreach ($departamento as $id => $descripcion)
                                        <option value="{{ $id }}">

                                            {{ $descripcion }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <!-- CIUDAD -->
                            <div class="form-group col-md-6">

                                <label for="modal_id_ciudad">

                                    Ciudad

                                    <span class="required">*</span>

                                </label>


                                <select name="id_ciudad" id="modal_id_ciudad" class="form-control select2"
                                    style="width: 100%;" required>

                                    <option value="">
                                        Seleccione ciudad...
                                    </option>


                                    @foreach ($ciudad as $id => $descripcion)
                                        <option value="{{ $id }}">

                                            {{ $descripcion }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>


                </div>


                <!-- ================================================= -->
                <!-- FOOTER -->
                <!-- ================================================= -->

                <div class="modal-footer">


                    <button type="button" class="btn btn-cancelar" data-dismiss="modal">

                        <i class="fas fa-times mr-1"></i>

                        Cancelar

                    </button>


                    <button type="submit" id="btn-guardar-cliente" class="btn btn-success btn-guardar">

                        <i class="fas fa-save mr-1"></i>

                        Guardar cliente

                    </button>


                </div>


            </form>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->
@push('page_scripts')
<script>
    console.log('SCRIPT CLIENTE CARGADO');

    $(document).ready(function() {

        console.log('DOCUMENT READY');

        $(document).on('submit', '#form-cliente-modal', function(e) {

            console.log('SUBMIT MODAL DETECTADO');

            e.preventDefault();
        });
    });

    $(document).ready(function() {

        /* =========================================================
           SELECT2 - DEPARTAMENTO
        ========================================================= */

        $('#modal_id_departamento').select2({
            width: '100%',
            dropdownParent: $('#modalCliente'),
            placeholder: 'Seleccione departamento',
            allowClear: true
        });


        /* =========================================================
           SELECT2 - CIUDAD
        ========================================================= */

        $('#modal_id_ciudad').select2({
            width: '100%',
            dropdownParent: $('#modalCliente'),
            placeholder: 'Seleccione ciudad',
            allowClear: true
        });


        /* =========================================================
           SUBMIT FORMULARIO CLIENTE
        ========================================================= */

        $(document).on('submit', '#form-cliente-modal', function(e) {

            e.preventDefault();

            let form = this;
            let boton = $('#btn-guardar-cliente');


            /* =====================================================
               VALIDACIÓN MANUAL
            ===================================================== */

            let cli_ci = $('#modal_cli_ci').val().trim();
            let cli_nombre = $('#modal_cli_nombre').val().trim();
            let cli_direccion = $('#modal_cli_direccion').val().trim();
            let cli_telefono = $('#modal_cli_telefono').val().trim();

            let id_departamento = $('#modal_id_departamento').val();
            let id_ciudad = $('#modal_id_ciudad').val();


            /* =====================================================
               VALIDAR CI
            ===================================================== */

            if (cli_ci === '') {

                Swal.fire({
                    icon: 'warning',
                    title: 'Campo obligatorio',
                    text: 'Debe ingresar el C.I. / R.U.C.'
                });

                $('#modal_cli_ci').focus();

                return;
            }


            /* =====================================================
               VALIDAR NOMBRE
            ===================================================== */

            if (cli_nombre === '') {

                Swal.fire({
                    icon: 'warning',
                    title: 'Campo obligatorio',
                    text: 'Debe ingresar el nombre del cliente.'
                });

                $('#modal_cli_nombre').focus();

                return;
            }


            /* =====================================================
               VALIDAR DIRECCIÓN
            ===================================================== */

            if (cli_direccion === '') {

                Swal.fire({
                    icon: 'warning',
                    title: 'Campo obligatorio',
                    text: 'Debe ingresar la dirección.'
                });

                $('#modal_cli_direccion').focus();

                return;
            }


            /* =====================================================
               VALIDAR TELÉFONO
            ===================================================== */

            if (cli_telefono === '') {

                Swal.fire({
                    icon: 'warning',
                    title: 'Campo obligatorio',
                    text: 'Debe ingresar el teléfono.'
                });

                $('#modal_cli_telefono').focus();

                return;
            }


            /* =====================================================
               VALIDAR DEPARTAMENTO
            ===================================================== */

            if (!id_departamento) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Campo obligatorio',
                    text: 'Debe seleccionar un departamento.'
                });

                $('#modal_id_departamento').select2('open');

                return;
            }


            /* =====================================================
               VALIDAR CIUDAD
            ===================================================== */

            if (!id_ciudad) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Campo obligatorio',
                    text: 'Debe seleccionar una ciudad.'
                });

                $('#modal_id_ciudad').select2('open');

                return;
            }


            /* =====================================================
               DESHABILITAR BOTÓN
            ===================================================== */

            boton.prop('disabled', true);

            boton.html(
                '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...'
            );


            /* =====================================================
               AJAX
            ===================================================== */

            $.ajax({

                url: $(form).attr('action'),

                type: 'POST',

                data: $(form).serialize(),

                dataType: 'json',

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },


                /* =================================================
                   ÉXITO
                ================================================= */

                success: function(response) {

                    console.log('RESPUESTA:', response);


                    if (response.success && response.cliente) {

                        let cliente = response.cliente;


                        /* =========================================
                           NOMBRE DEL CLIENTE
                        ========================================= */

                        let nombreCliente =
                            cliente.cli_ci +
                            ' - ' +
                            cliente.cli_nombre +
                            ' ' +
                            (cliente.cli_apellido || '');


                        /* =========================================
                           AGREGAR AL SELECT DE CLIENTES
                        ========================================= */

                        let option = new Option(
                            nombreCliente,
                            cliente.id_cliente,
                            true,
                            true
                        );


                        $('#id_cliente')
                            .append(option)
                            .trigger('change');


                        /* =========================================
                           CERRAR MODAL
                        ========================================= */

                        $('#modalCliente').modal('hide');


                        /* =========================================
                           LIMPIAR FORMULARIO
                        ========================================= */

                        form.reset();


                        $('#modal_id_departamento')
                            .val(null)
                            .trigger('change');


                        $('#modal_id_ciudad')
                            .val(null)
                            .trigger('change');


                        /* =========================================
                           MENSAJE
                        ========================================= */

                        Swal.fire({

                            icon: 'success',

                            title: 'Cliente creado',

                            text: 'El cliente fue registrado correctamente.',

                            timer: 1800,

                            showConfirmButton: false,

                            toast: true,

                            position: 'top-end'

                        });


                    } else {

                        Swal.fire({

                            icon: 'warning',

                            title: 'Atención',

                            text: response.message ||
                                'No fue posible registrar el cliente.'

                        });

                    }

                },


                /* =================================================
                   ERROR
                ================================================= */

                error: function(xhr) {

                    console.log('ERROR AJAX:', xhr);

                    console.log(
                        'RESPUESTA:',
                        xhr.responseText
                    );


                    let mensaje =
                        'Ocurrió un error al guardar el cliente.';


                    /* =============================================
                       ERROR JSON
                    ============================================= */

                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        mensaje =
                            xhr.responseJSON.message;

                    }


                    /* =============================================
                       ERROR 422
                    ============================================= */

                    if (
                        xhr.status === 422 &&
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        let errores = [];


                        $.each(
                            xhr.responseJSON.errors,
                            function(campo, mensajes) {

                                errores.push(
                                    mensajes[0]
                                );

                            }
                        );


                        mensaje = errores.join('\n');

                    }


                    Swal.fire({

                        icon: 'warning',

                        title: 'Atención',

                        text: mensaje,

                        confirmButtonText: 'Aceptar'

                    });

                },


                /* =================================================
                   FINALIZAR
                ================================================= */

                complete: function() {

                    boton.prop(
                        'disabled',
                        false
                    );

                    boton.html(
                        '<i class="fas fa-save mr-1"></i> Guardar cliente'
                    );

                }

            });

        });


        /* =========================================================
           LIMPIAR AL CERRAR MODAL
        ========================================================= */

        $('#modalCliente').on(
            'hidden.bs.modal',
            function() {

                let form =
                    $('#form-cliente-modal')[0];


                if (form) {

                    form.reset();

                }


                $('#modal_id_departamento')
                    .val(null)
                    .trigger('change');


                $('#modal_id_ciudad')
                    .val(null)
                    .trigger('change');


                $('#btn-guardar-cliente')
                    .prop('disabled', false)
                    .html(
                        '<i class="fas fa-save mr-1"></i> Guardar cliente'
                    );

            }
        );

    });
</script>
@endpush

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/pedido-modal-cliente.css') }}?v=20260918-2">
@endpush
