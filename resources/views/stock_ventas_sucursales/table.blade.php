<div class="import-container">

    {{-- ENCABEZADO --}}
    <div class="import-header">

        <div class="header-content">

            <div class="header-icon">
                <i class="fas fa-chart-line"></i>
            </div>

            <div>
                <h2>Importación de Ventas y Stock</h2>

                <p>
                    Carga y actualización de información comercial por sucursal
                </p>
            </div>

        </div>

        <div class="header-status">
            <span class="status-dot"></span>
            Sistema disponible
        </div>

    </div>


    {{-- CONTENIDO --}}
    <div class="import-body">

        <form id="formImportVentas"
            action="{{ route('import.stock.ventas.sucursales') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf


            {{-- INFORMACIÓN --}}
            <div class="section-title">

                <div class="section-icon">
                    <i class="fas fa-file-excel"></i>
                </div>

                <div>
                    <h4>Archivo de importación</h4>

                    <p>
                        Seleccione el archivo Excel que contiene las ventas y stock.
                    </p>
                </div>

            </div>


            {{-- DROPZONE --}}
            <div class="upload-zone" id="uploadZone">

                <input type="file"
                    name="archivo"
                    id="archivoInput"
                    accept=".xlsx,.xls"
                    required>

                <div class="upload-content">

                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>

                    <h4 id="uploadTitle">
                        Seleccione su archivo Excel
                    </h4>

                    <p id="uploadDescription">
                        Arrastre el archivo aquí o haga clic para seleccionarlo
                    </p>

                    <span class="upload-button">
                        <i class="fas fa-folder-open mr-2"></i>
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
                            <i class="fas fa-database"></i>
                            Ventas y Stock
                        </span>

                    </div>

                </div>

            </div>


            {{-- ARCHIVO SELECCIONADO --}}
            <div id="fileInfo" class="file-info">

                <div class="file-info-icon">
                    <i class="fas fa-file-excel"></i>
                </div>

                <div class="file-details">

                    <strong id="fileName">
                        Archivo seleccionado
                    </strong>

                    <span id="fileSize">
                        —
                    </span>

                </div>

                <button type="button"
                    id="removeFile"
                    class="remove-file"
                    title="Eliminar archivo">

                    <i class="fas fa-times"></i>

                </button>

            </div>


            {{-- INFORMACIÓN DEL PROCESO --}}
            <div class="process-info">

                <div class="info-item">

                    <div class="info-item-icon">
                        <i class="fas fa-store"></i>
                    </div>

                    <div>
                        <span>Proceso</span>
                        <strong>Ventas y Stock</strong>
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-item-icon">
                        <i class="fas fa-code-branch"></i>
                    </div>

                    <div>
                        <span>Alcance</span>
                        <strong>Por sucursal</strong>
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-item-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>

                    <div>
                        <span>Actualización</span>
                        <strong>Automática</strong>
                    </div>

                </div>

            </div>


            {{-- BOTONES --}}
            <div class="form-actions">

                <div class="security-message">

                    <i class="fas fa-shield-alt"></i>

                    <span>
                        La información será procesada de forma segura
                    </span>

                </div>


                <button type="submit"
                    id="btnImportar"
                    class="btn-import"
                    disabled>

                    <i class="fas fa-upload"></i>

                    <span>Iniciar importación</span>

                </button>

            </div>

        </form>

    </div>

</div>


{{-- ========================================================= --}}
{{-- OVERLAY DE IMPORTACIÓN --}}
{{-- ========================================================= --}}

<div id="loadingOverlay">

    <div class="loading-box">


        {{-- ICONO --}}
        <div class="loading-icon">

            <div class="loading-icon-inner">

                <i class="fas fa-file-import"></i>

            </div>

        </div>


        {{-- ESTADO --}}
        <div class="loading-status">

            <span class="loading-dot"></span>

            Procesando información

        </div>


        <h3>
            Importando ventas y stock
        </h3>


        <p class="loading-description">

            Estamos procesando la información del archivo.
            Este proceso puede tardar unos momentos.

        </p>


        {{-- PROGRESO --}}
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


        {{-- TIEMPO --}}
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

            No cierre esta ventana mientras la importación esté en proceso.

        </div>

    </div>

</div>





@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('formImportVentas');

        const input = document.getElementById('archivoInput');

        const uploadZone = document.getElementById('uploadZone');

        const fileInfo = document.getElementById('fileInfo');

        const fileName = document.getElementById('fileName');

        const fileSize = document.getElementById('fileSize');

        const removeFile = document.getElementById('removeFile');

        const btnImportar = document.getElementById('btnImportar');

        const uploadTitle = document.getElementById('uploadTitle');

        const uploadDescription = document.getElementById('uploadDescription');

        const loadingOverlay = document.getElementById('loadingOverlay');

        const progressBar = document.getElementById('progressBar');

        const progressPercent = document.getElementById('progressPercent');

        const counter = document.getElementById('counter');


        let seconds = 0;

        let progress = 0;

        let timer = null;

        let progressTimer = null;


        /* =====================================================
           FORMATO TAMAÑO
        ===================================================== */

        function formatFileSize(bytes) {

            if (bytes === 0) return '0 Bytes';

            const units = ['Bytes', 'KB', 'MB', 'GB'];

            const i = Math.floor(
                Math.log(bytes) / Math.log(1024)
            );

            return (
                parseFloat(
                    (bytes / Math.pow(1024, i)).toFixed(2)
                ) + ' ' + units[i]
            );

        }


        /* =====================================================
           MOSTRAR ARCHIVO
        ===================================================== */

        function showFile(file) {

            if (!file) {

                resetFile();

                return;

            }


            const extension = file.name
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

                    confirmButtonColor: '#16a34a'

                });

                resetFile();

                return;

            }


            fileName.textContent = file.name;

            fileSize.textContent =
                formatFileSize(file.size);


            fileInfo.classList.add('show');

            btnImportar.disabled = false;


            uploadTitle.textContent =
                'Archivo listo para importar';


            uploadDescription.textContent =
                'El archivo ha sido seleccionado correctamente.';


            uploadZone.classList.add('selected');

        }


        /* =====================================================
           RESET
        ===================================================== */

        function resetFile() {

            input.value = '';

            fileInfo.classList.remove('show');

            btnImportar.disabled = true;

            uploadTitle.textContent =
                'Seleccione su archivo Excel';

            uploadDescription.textContent =
                'Arrastre el archivo aquí o haga clic para seleccionarlo';

            uploadZone.classList.remove('selected');

        }


        /* =====================================================
           CHANGE FILE
        ===================================================== */

        input.addEventListener('change', function() {

            showFile(this.files[0]);

        });


        /* =====================================================
           REMOVE FILE
        ===================================================== */

        removeFile.addEventListener('click', function() {

            resetFile();

        });


        /* =====================================================
           DRAG & DROP
        ===================================================== */

        uploadZone.addEventListener('dragover', function(e) {

            e.preventDefault();

            uploadZone.classList.add('dragover');

        });


        uploadZone.addEventListener('dragleave', function() {

            uploadZone.classList.remove('dragover');

        });


        uploadZone.addEventListener('drop', function(e) {

            e.preventDefault();

            uploadZone.classList.remove('dragover');


            const files = e.dataTransfer.files;


            if (!files.length) return;


            try {

                const dataTransfer = new DataTransfer();

                dataTransfer.items.add(files[0]);

                input.files = dataTransfer.files;

                showFile(files[0]);

            } catch (error) {

                console.error(error);

            }

        });


        /* =====================================================
           SUBMIT
        ===================================================== */

        form.addEventListener('submit', function() {

            loadingOverlay.style.display = 'flex';


            btnImportar.disabled = true;

            btnImportar.innerHTML = `

            <span class="spinner-border spinner-border-sm"></span>

            Procesando...

        `;


            seconds = 0;

            progress = 0;


            counter.textContent = '0s';

            progressBar.style.width = '0%';

            progressPercent.textContent = '0%';


            /* TIEMPO */

            timer = setInterval(function() {

                seconds++;

                counter.textContent =
                    seconds + 's';

            }, 1000);


            /* PROGRESO VISUAL */

            progressTimer = setInterval(function() {

                if (progress < 92) {

                    const increment =
                        Math.random() * 5 + 1;

                    progress = Math.min(
                        progress + increment,
                        92
                    );


                    progressBar.style.width =
                        progress + '%';


                    progressPercent.textContent =
                        Math.floor(progress) + '%';

                }

            }, 700);

        });


    });
</script>
@endpush

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/stock-ventas-table.css') }}?v=20260918-3">
@endpush
