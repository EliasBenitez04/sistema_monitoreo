@include('sweetalert::alert')

<div class="imports-wrapper">

    {{-- =========================================================
         ENCABEZADO GENERAL
    ========================================================== --}}

    <div class="imports-main-header">

        <div class="main-header-content">

            <div class="main-header-icon">
                <i class="fas fa-database"></i>
            </div>

            <div>

                <h2>
                    Importación de Información
                </h2>

                <p>
                    Gestión y actualización de información operativa
                </p>

            </div>

        </div>

        <div class="system-status">

            <span class="system-status-dot"></span>

            Sistema disponible

        </div>

    </div>


    {{-- =========================================================
         IMPORTACIÓN TRAZABILIDAD OT
    ========================================================== --}}

    <div class="import-module">

        <div class="module-header module-header-blue">

            <div class="module-title-area">

                <div class="module-icon blue-icon">

                    <i class="fas fa-project-diagram"></i>

                </div>

                <div>

                    <h3>
                        Trazabilidad de Órdenes de Trabajo
                    </h3>

                    <p>
                        Importación de procesos y registros históricos de OT
                    </p>

                </div>

            </div>

            <span class="module-badge badge-blue">

                <i class="fas fa-industry"></i>

                Producción

            </span>

        </div>


        <div class="module-body">

            <form id="formImportOT"
                action="{{ route('ot.importar') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="section-label">

                    <i class="fas fa-file-excel"></i>

                    Archivo de trazabilidad

                </div>


                {{-- DROPZONE OT --}}

                <div class="upload-zone upload-zone-blue"
                    id="uploadZoneOT">

                    <input type="file"
                        name="archivo"
                        id="archivoInput"
                        accept=".xlsx,.xls"
                        required>


                    <div class="upload-content">

                        <div class="upload-icon blue-upload-icon">

                            <i class="fas fa-cloud-upload-alt"></i>

                        </div>


                        <h4 id="uploadTitleOT">

                            Seleccione el archivo Excel

                        </h4>


                        <p id="uploadDescriptionOT">

                            Arrastre el archivo aquí o haga clic para seleccionarlo

                        </p>


                        <span class="upload-button">

                            <i class="fas fa-folder-open"></i>

                            Buscar archivo

                        </span>


                        <div class="supported-files">

                            <span>
                                <i class="fas fa-check-circle"></i>
                                XLSX
                            </span>

                            <span>
                                <i class="fas fa-check-circle"></i>
                                XLS
                            </span>

                            <span>
                                <i class="fas fa-history"></i>
                                Trazabilidad histórica
                            </span>

                        </div>

                    </div>

                </div>


                {{-- ARCHIVO OT --}}

                <div id="fileInfoOT"
                    class="file-info">

                    <div class="file-info-icon blue-file-icon">

                        <i class="fas fa-file-excel"></i>

                    </div>


                    <div class="file-details">

                        <strong id="fileNameOT">
                            Archivo seleccionado
                        </strong>

                        <span id="fileSizeOT">
                            —
                        </span>

                    </div>


                    <button type="button"
                        id="removeFileOT"
                        class="remove-file">

                        <i class="fas fa-times"></i>

                    </button>

                </div>


                {{-- INFORMACIÓN OT --}}

                <div class="process-info">

                    <div class="info-item">

                        <div class="info-item-icon">

                            <i class="fas fa-clipboard-list"></i>

                        </div>

                        <div>

                            <span>Información</span>

                            <strong>Órdenes de Trabajo</strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-item-icon">

                            <i class="fas fa-project-diagram"></i>

                        </div>

                        <div>

                            <span>Proceso</span>

                            <strong>Trazabilidad</strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-item-icon">

                            <i class="fas fa-history"></i>

                        </div>

                        <div>

                            <span>Tipo</span>

                            <strong>Histórico</strong>

                        </div>

                    </div>

                </div>


                {{-- ACCIONES --}}

                <div class="form-actions">

                    <div class="security-message">

                        <i class="fas fa-shield-alt"></i>

                        Información procesada de forma segura

                    </div>


                    <button type="submit"
                        id="btnImportar"
                        class="btn-import btn-import-blue"
                        disabled>

                        <i class="fas fa-upload"></i>

                        <span>Importar trazabilidad</span>

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
         IMPORTACIÓN LOGÍSTICA
    ========================================================== --}}

    <div class="import-module">

        <div class="module-header module-header-green">

            <div class="module-title-area">

                <div class="module-icon green-icon">

                    <i class="fas fa-truck"></i>

                </div>

                <div>

                    <h3>
                        Logística y Distribución
                    </h3>

                    <p>
                        Importación de OTs terminadas y movimientos logísticos
                    </p>

                </div>

            </div>


            <span class="module-badge badge-green">

                <i class="fas fa-truck-loading"></i>

                Logística

            </span>

        </div>


        <div class="module-body">

            <form id="formImportLogistica"
                action="{{ route('ot.importar.logistica') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                {{-- FECHA --}}

                <div class="date-section">

                    <div class="date-label">

                        <div class="date-icon">

                            <i class="far fa-calendar-alt"></i>

                        </div>

                        <div>

                            <strong>
                                Fecha del proceso
                            </strong>

                            <span>
                                Fecha asociada a la importación logística
                            </span>

                        </div>

                    </div>


                    <input type="date"
                        name="fecha_proceso"
                        id="fechaProceso"
                        class="date-input"
                        required
                        value="{{ date('Y-m-d') }}">

                </div>


                <div class="section-label">

                    <i class="fas fa-file-excel"></i>

                    Archivo de logística

                </div>


                {{-- DROPZONE LOGÍSTICA --}}

                <div class="upload-zone upload-zone-green"
                    id="uploadZoneLogistica">

                    <input type="file"
                        name="archivo"
                        id="archivoLogistica"
                        accept=".xlsx,.xls"
                        required>


                    <div class="upload-content">

                        <div class="upload-icon green-upload-icon">

                            <i class="fas fa-cloud-upload-alt"></i>

                        </div>


                        <h4 id="uploadTitleLogistica">

                            Seleccione el archivo Excel

                        </h4>


                        <p id="uploadDescriptionLogistica">

                            Arrastre el archivo aquí o haga clic para seleccionarlo

                        </p>


                        <span class="upload-button">

                            <i class="fas fa-folder-open"></i>

                            Buscar archivo

                        </span>


                        <div class="supported-files">

                            <span>
                                <i class="fas fa-check-circle"></i>
                                XLSX
                            </span>

                            <span>
                                <i class="fas fa-check-circle"></i>
                                XLS
                            </span>

                            <span>
                                <i class="fas fa-route"></i>
                                Distribución
                            </span>

                        </div>

                    </div>

                </div>


                {{-- ARCHIVO LOGÍSTICA --}}

                <div id="fileInfoLogistica"
                    class="file-info">

                    <div class="file-info-icon green-file-icon">

                        <i class="fas fa-file-excel"></i>

                    </div>


                    <div class="file-details">

                        <strong id="fileNameLogistica">
                            Archivo seleccionado
                        </strong>

                        <span id="fileSizeLogistica">
                            —
                        </span>

                    </div>


                    <button type="button"
                        id="removeFileLogistica"
                        class="remove-file">

                        <i class="fas fa-times"></i>

                    </button>

                </div>


                {{-- INFORMACIÓN LOGÍSTICA --}}

                <div class="process-info">

                    <div class="info-item">

                        <div class="info-item-icon">

                            <i class="fas fa-truck"></i>

                        </div>

                        <div>

                            <span>Área</span>

                            <strong>Logística</strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-item-icon">

                            <i class="fas fa-boxes"></i>

                        </div>

                        <div>

                            <span>Información</span>

                            <strong>OT terminadas</strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-item-icon">

                            <i class="fas fa-calendar-check"></i>

                        </div>

                        <div>

                            <span>Fecha</span>

                            <strong id="fechaMostrar">
                                {{ date('d/m/Y') }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- ACCIONES --}}

                <div class="form-actions">

                    <div class="security-message">

                        <i class="fas fa-shield-alt"></i>

                        Información procesada de forma segura

                    </div>


                    <button type="submit"
                        id="btnImportarLogistica"
                        class="btn-import btn-import-green"
                        disabled>

                        <i class="fas fa-truck-loading"></i>

                        <span>Importar logística</span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TRAZABILIDAD OT
========================================================= --}}

<div id="loadingOverlay">

    <div class="loading-box">

        <div class="loading-icon loading-icon-blue">

            <div class="loading-icon-inner">

                <i class="fas fa-project-diagram"></i>

            </div>

        </div>


        <div class="loading-status loading-status-blue">

            <span class="loading-dot"></span>

            Procesando información

        </div>


        <h3>
            Importando trazabilidad de OT
        </h3>


        <p class="loading-description">

            Procesando órdenes de trabajo, procesos
            y registros históricos.

        </p>


        <div class="progress-container">

            <div class="progress-header">

                <span>
                    Progreso
                </span>

                <strong id="progressPercent">
                    0%
                </strong>

            </div>


            <div class="progress-custom">

                <div id="progressBar"></div>

            </div>

        </div>


        <div class="loading-footer">

            <div>

                <i class="far fa-clock"></i>

                Tiempo transcurrido

            </div>

            <strong id="counter">
                0s
            </strong>

        </div>


        <div class="loading-warning">

            <i class="fas fa-info-circle"></i>

            No cierre esta ventana mientras se procesa la información.

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL LOGÍSTICA
========================================================= --}}

<div id="loadingOverlayLogistica">

    <div class="loading-box">

        <div class="loading-icon loading-icon-green">

            <div class="loading-icon-inner">

                <i class="fas fa-truck"></i>

            </div>

        </div>


        <div class="loading-status loading-status-green">

            <span class="loading-dot"></span>

            Procesando información

        </div>


        <h3>
            Importando logística
        </h3>


        <p class="loading-description">

            Procesando OTs terminadas y generando
            registros de Logística y Distribución.

        </p>


        <div class="progress-container">

            <div class="progress-header">

                <span>
                    Progreso
                </span>

                <strong id="progressPercentLogistica">
                    0%
                </strong>

            </div>


            <div class="progress-custom">

                <div id="progressBarLogistica"></div>

            </div>

        </div>


        <div class="loading-footer">

            <div>

                <i class="far fa-clock"></i>

                Tiempo transcurrido

            </div>

            <strong id="counterLogistica">
                0s
            </strong>

        </div>


        <div class="loading-warning">

            <i class="fas fa-info-circle"></i>

            No cierre esta ventana mientras se procesa la información.

        </div>

    </div>

</div>





@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {


        /* =====================================================
           FUNCIÓN FORMATO ARCHIVO
        ====================================================== */

        function formatFileSize(bytes) {

            if (!bytes) return '0 Bytes';

            const units = [
                'Bytes',
                'KB',
                'MB',
                'GB'
            ];

            const i = Math.floor(
                Math.log(bytes) / Math.log(1024)
            );

            return (
                parseFloat(
                    (bytes / Math.pow(1024, i))
                    .toFixed(2)
                ) +
                ' ' +
                units[i]
            );

        }


        /* =====================================================
           CONFIGURAR IMPORTACIÓN
        ====================================================== */

        function configureUpload(config) {

            const input =
                document.getElementById(config.input);

            const zone =
                document.getElementById(config.zone);

            const fileInfo =
                document.getElementById(config.fileInfo);

            const fileName =
                document.getElementById(config.fileName);

            const fileSize =
                document.getElementById(config.fileSize);

            const remove =
                document.getElementById(config.remove);

            const button =
                document.getElementById(config.button);

            const title =
                document.getElementById(config.title);

            const description =
                document.getElementById(config.description);


            function reset() {

                input.value = '';

                fileInfo.classList.remove('show');

                button.disabled = true;

                title.textContent =
                    'Seleccione el archivo Excel';

                description.textContent =
                    'Arrastre el archivo aquí o haga clic para seleccionarlo';

            }


            function processFile(file) {

                if (!file) {

                    reset();

                    return;

                }


                const extension =
                    file.name
                    .split('.')
                    .pop()
                    .toLowerCase();


                if (!['xlsx', 'xls'].includes(extension)) {

                    input.value = '';

                    Swal.fire({

                        icon: 'warning',

                        title: 'Archivo no válido',

                        text: 'Seleccione un archivo Excel en formato XLSX o XLS.',

                        confirmButtonText: 'Entendido',

                        confirmButtonColor: config.color

                    });

                    reset();

                    return;

                }


                fileName.textContent =
                    file.name;

                fileSize.textContent =
                    formatFileSize(file.size);


                fileInfo.classList.add('show');

                button.disabled = false;


                title.textContent =
                    'Archivo listo para importar';


                description.textContent =
                    'El archivo ha sido seleccionado correctamente.';

            }


            input.addEventListener(
                'change',
                function() {

                    processFile(this.files[0]);

                }
            );


            remove.addEventListener(
                'click',
                function() {

                    reset();

                }
            );


            zone.addEventListener(
                'dragover',
                function(e) {

                    e.preventDefault();

                    zone.classList.add('dragover');

                }
            );


            zone.addEventListener(
                'dragleave',
                function() {

                    zone.classList.remove('dragover');

                }
            );


            zone.addEventListener(
                'drop',
                function(e) {

                    e.preventDefault();

                    zone.classList.remove('dragover');


                    const files =
                        e.dataTransfer.files;


                    if (!files.length) return;


                    try {

                        const dataTransfer =
                            new DataTransfer();

                        dataTransfer.items.add(
                            files[0]
                        );

                        input.files =
                            dataTransfer.files;

                        processFile(files[0]);

                    } catch (error) {

                        console.error(error);

                    }

                }
            );


            return reset;

        }


        /* =====================================================
           OT
        ====================================================== */

        configureUpload({

            input: 'archivoInput',

            zone: 'uploadZoneOT',

            fileInfo: 'fileInfoOT',

            fileName: 'fileNameOT',

            fileSize: 'fileSizeOT',

            remove: 'removeFileOT',

            button: 'btnImportar',

            title: 'uploadTitleOT',

            description: 'uploadDescriptionOT',

            color: '#2563eb'

        });


        /* =====================================================
           LOGÍSTICA
        ====================================================== */

        configureUpload({

            input: 'archivoLogistica',

            zone: 'uploadZoneLogistica',

            fileInfo: 'fileInfoLogistica',

            fileName: 'fileNameLogistica',

            fileSize: 'fileSizeLogistica',

            remove: 'removeFileLogistica',

            button: 'btnImportarLogistica',

            title: 'uploadTitleLogistica',

            description: 'uploadDescriptionLogistica',

            color: '#16a34a'

        });


        /* =====================================================
           FECHA
        ====================================================== */

        const fechaProceso =
            document.getElementById('fechaProceso');

        const fechaMostrar =
            document.getElementById('fechaMostrar');


        function actualizarFecha() {

            if (!fechaProceso.value) return;


            const partes =
                fechaProceso.value.split('-');


            fechaMostrar.textContent =
                partes[2] +
                '/' +
                partes[1] +
                '/' +
                partes[0];

        }


        fechaProceso.addEventListener(
            'change',
            actualizarFecha
        );


        /* =====================================================
           IMPORTACIÓN OT
        ====================================================== */

        document
            .getElementById('formImportOT')
            .addEventListener(
                'submit',
                function() {

                    const overlay =
                        document.getElementById(
                            'loadingOverlay'
                        );

                    const button =
                        document.getElementById(
                            'btnImportar'
                        );

                    const bar =
                        document.getElementById(
                            'progressBar'
                        );

                    const percent =
                        document.getElementById(
                            'progressPercent'
                        );

                    const counter =
                        document.getElementById(
                            'counter'
                        );


                    overlay.style.display =
                        'flex';

                    button.disabled =
                        true;

                    button.innerHTML = `

                    <span class="spinner-border spinner-border-sm"></span>

                    Procesando...

                `;


                    let seconds = 0;

                    let progress = 0;


                    setInterval(function() {

                        seconds++;

                        counter.textContent =
                            seconds + 's';

                    }, 1000);


                    setInterval(function() {

                        if (progress < 92) {

                            progress = Math.min(
                                progress +
                                (Math.random() * 5 + 1),
                                92
                            );


                            bar.style.width =
                                progress + '%';


                            percent.textContent =
                                Math.floor(progress) + '%';

                        }

                    }, 700);

                }
            );


        /* =====================================================
           IMPORTACIÓN LOGÍSTICA
        ====================================================== */

        document
            .getElementById('formImportLogistica')
            .addEventListener(
                'submit',
                function() {

                    const overlay =
                        document.getElementById(
                            'loadingOverlayLogistica'
                        );

                    const button =
                        document.getElementById(
                            'btnImportarLogistica'
                        );

                    const bar =
                        document.getElementById(
                            'progressBarLogistica'
                        );

                    const percent =
                        document.getElementById(
                            'progressPercentLogistica'
                        );

                    const counter =
                        document.getElementById(
                            'counterLogistica'
                        );


                    overlay.style.display =
                        'flex';

                    button.disabled =
                        true;

                    button.innerHTML = `

                    <span class="spinner-border spinner-border-sm"></span>

                    Procesando...

                `;


                    let seconds = 0;

                    let progress = 0;


                    setInterval(function() {

                        seconds++;

                        counter.textContent =
                            seconds + 's';

                    }, 1000);


                    setInterval(function() {

                        if (progress < 92) {

                            progress = Math.min(
                                progress +
                                (Math.random() * 5 + 1),
                                92
                            );


                            bar.style.width =
                                progress + '%';


                            percent.textContent =
                                Math.floor(progress) + '%';

                        }

                    }, 700);

                }
            );

    });
</script>
@endpush

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/ots-import.css') }}?v=20260918-3">
@endpush
