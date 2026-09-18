{{-- ================================================================
     MODAL - IMPORTAR REMISIONES
================================================================ --}}

<div class="modal fade" id="modalImportarRemisiones" tabindex="-1" role="dialog"
    aria-labelledby="modalImportarRemisionesLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

        <div class="modal-content import-modal">

            {{-- ====================================================
                 HEADER
            ===================================================== --}}
            <div class="modal-header import-modal-header">

                <div class="d-flex align-items-center">

                    {{-- Icono --}}
                    <div class="import-header-icon">
                        <i class="fas fa-file-import"></i>
                    </div>

                    {{-- Título --}}
                    <div class="ml-3">

                        <h5 class="modal-title import-title" id="modalImportarRemisionesLabel">

                            Importar remisiones

                        </h5>

                        <div class="import-subtitle">
                            Actualización de movimientos de redistribución
                        </div>

                    </div>

                </div>

                {{-- Cerrar --}}
                <button type="button" class="close import-close" data-dismiss="modal" aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            {{-- ====================================================
                 FORMULARIO
            ===================================================== --}}
            <form action="{{ route('RedistribucionSugeridas.importarRemisiones') }}" method="POST"
                enctype="multipart/form-data" id="formImportarRemisiones">

                @csrf

                {{-- =================================================
                     BODY
                ================================================== --}}
                <div class="modal-body import-modal-body">

                    {{-- =============================================
                         INFORMACIÓN PRINCIPAL
                    ============================================== --}}
                    <div class="import-info-card">

                        <div class="d-flex align-items-start">

                            <div class="import-info-icon">
                                <i class="fas fa-info"></i>
                            </div>

                            <div class="flex-grow-1">

                                <div class="import-info-title">
                                    ¿Qué realizará el sistema?
                                </div>

                                <div class="import-info-text">
                                    El archivo será procesado y las remisiones
                                    serán asociadas automáticamente con las
                                    redistribuciones existentes.
                                </div>

                            </div>

                        </div>


                        {{-- =========================================
                             CRITERIOS DE COINCIDENCIA
                        ========================================== --}}
                        <div class="import-match-list">

                            <div class="match-item">

                                <span class="match-icon">
                                    <i class="fas fa-check"></i>
                                </span>

                                <span>
                                    Sucursal de origen
                                </span>

                            </div>


                            <div class="match-item">

                                <span class="match-icon">
                                    <i class="fas fa-check"></i>
                                </span>

                                <span>
                                    Sucursal de destino
                                </span>

                            </div>


                            <div class="match-item">

                                <span class="match-icon">
                                    <i class="fas fa-check"></i>
                                </span>

                                <span>
                                    Código de artículo
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                         SECCIÓN ARCHIVO
                    ============================================== --}}
                    <div class="import-file-section">

                        <label for="archivoRemisiones" class="import-label">

                            Archivo de remisiones

                            <span class="required-mark">*</span>

                        </label>


                        {{-- Contenedor --}}
                        <div class="import-file-wrapper">

                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="archivoRemisiones" name="archivo"
                                    accept=".xlsx,.xls" required>

                                <label class="custom-file-label" for="archivoRemisiones" id="archivoRemisionesLabel">

                                    <span class="file-placeholder">

                                        <i class="fas fa-folder-open mr-2"></i>

                                        Seleccionar archivo Excel...

                                    </span>

                                </label>

                            </div>

                        </div>


                        {{-- Información del archivo --}}
                        <div class="import-file-help">

                            <span>
                                <i class="fas fa-file-excel mr-1"></i>
                                Formatos permitidos:
                                <strong>XLSX</strong> y <strong>XLS</strong>
                            </span>

                            <span class="file-size-help">
                                Archivo Excel
                            </span>

                        </div>

                    </div>


                    {{-- =============================================
                         ARCHIVO SELECCIONADO
                    ============================================== --}}
                    <div id="archivoSeleccionado" class="selected-file-card d-none">

                        <div class="selected-file-icon">

                            <i class="fas fa-file-excel"></i>

                        </div>

                        <div class="selected-file-info">

                            <div class="selected-file-title">
                                Archivo seleccionado
                            </div>

                            <div id="nombreArchivo" class="selected-file-name">

                                --

                            </div>

                        </div>

                        <div class="selected-file-check">

                            <i class="fas fa-check-circle"></i>

                        </div>

                    </div>


                    {{-- =============================================
                         AVISO
                    ============================================== --}}
                    <div class="import-warning">

                        <div class="warning-icon">

                            <i class="fas fa-shield-alt"></i>

                        </div>

                        <div class="warning-content">

                            <div class="warning-title">
                                Importación segura
                            </div>

                            <div class="warning-text">

                                Los registros coincidentes serán actualizados
                                automáticamente. Los movimientos finalizados
                                no serán modificados.

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     FOOTER
                ================================================== --}}
                <div class="modal-footer import-modal-footer">

                    <button type="button" class="btn btn-light import-btn-cancel" data-dismiss="modal">

                        <i class="fas fa-times mr-1"></i>

                        Cancelar

                    </button>


                    <button type="submit" class="btn btn-primary import-btn-submit" id="btnImportarRemisiones">

                        <i class="fas fa-cloud-upload-alt mr-1"></i>

                        Importar archivo

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ================================================================
     ESTILOS
================================================================ --}}




{{-- ================================================================
     JAVASCRIPT
================================================================ --}}

<script>
    $(document).ready(function() {

        const inputArchivo = $('#archivoRemisiones');
        const labelArchivo = $('#archivoRemisionesLabel');
        const archivoSeleccionado = $('#archivoSeleccionado');
        const nombreArchivo = $('#nombreArchivo');
        const form = $('#formImportarRemisiones');
        const btnImportar = $('#btnImportarRemisiones');


        /* =========================================================
           SELECCIÓN DEL ARCHIVO
        ========================================================== */

        inputArchivo.on('change', function() {

            const archivo = this.files && this.files.length ?
                this.files[0] :
                null;


            /* -----------------------------------------------------
               Si no hay archivo
            ----------------------------------------------------- */

            if (!archivo) {

                labelArchivo.html(`
                    <span class="file-placeholder">
                        <i class="fas fa-folder-open mr-2"></i>
                        Seleccionar archivo Excel...
                    </span>
                `);

                archivoSeleccionado.addClass('d-none');

                return;
            }


            /* -----------------------------------------------------
               Validar extensión
            ----------------------------------------------------- */

            const nombre = archivo.name;

            const extension = nombre
                .split('.')
                .pop()
                .toLowerCase();


            const extensionesPermitidas = [
                'xlsx',
                'xls'
            ];


            if (!extensionesPermitidas.includes(extension)) {

                inputArchivo.val('');

                archivoSeleccionado.addClass('d-none');

                labelArchivo.html(`
                    <span class="file-placeholder text-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Seleccionar archivo Excel...
                    </span>
                `);

                alert('El archivo seleccionado no tiene un formato válido. Utilice XLSX o XLS.');

                return;
            }


            /* -----------------------------------------------------
               Mostrar nombre en input
            ----------------------------------------------------- */

            labelArchivo.html(`
                <span class="file-placeholder">
                    <i class="fas fa-file-excel mr-2 text-success"></i>
                    ${escapeHtml(nombre)}
                </span>
            `);


            /* -----------------------------------------------------
               Mostrar tarjeta de archivo seleccionado
            ----------------------------------------------------- */

            nombreArchivo.text(nombre);

            archivoSeleccionado
                .removeClass('d-none')
                .hide()
                .fadeIn(180);

        });


        /* =========================================================
           SUBMIT
        ========================================================== */

        form.on('submit', function() {

            if (!inputArchivo.val()) {

                return;

            }


            /* -----------------------------------------------------
               Evitar doble envío
            ----------------------------------------------------- */

            btnImportar
                .prop('disabled', true)
                .html(`
                    <span class="spinner-border spinner-border-sm mr-2"
                          role="status"
                          aria-hidden="true"></span>

                    Procesando...
                `);

        });


        /* =========================================================
           LIMPIAR AL CERRAR MODAL
        ========================================================== */

        $('#modalImportarRemisiones').on('hidden.bs.modal', function() {

            form[0].reset();

            archivoSeleccionado.addClass('d-none');

            labelArchivo.html(`
                <span class="file-placeholder">
                    <i class="fas fa-folder-open mr-2"></i>
                    Seleccionar archivo Excel...
                </span>
            `);


            btnImportar
                .prop('disabled', false)
                .html(`
                    <i class="fas fa-cloud-upload-alt mr-1"></i>
                    Importar archivo
                `);

        });


        /* =========================================================
           ESCAPAR HTML
           Evita insertar directamente el nombre del archivo
        ========================================================== */

        function escapeHtml(text) {

            return $('<div>')
                .text(text)
                .html();

        }

    });
</script>

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/redistribucion-importar-remisiones.css') }}?v=20260918-2">
@endpush
