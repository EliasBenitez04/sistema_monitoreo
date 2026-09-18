<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos</title>
    
</head>

<body>

    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="card-header">
                <div class="row align-items-center">

                    <!-- Formulario de Filtro por Precio -->
                    <div class="table-responsive">
                        <div class="card-header">
                            <div class="row align-items-center">

                                <!-- FILTRO ORDEN PRECIO -->
                                <div class="col-md-4 mb-2">
                                    <form method="GET" action="{{ route('articulos.index') }}">
                                        <label>Ordenar por Precio:</label>

                                        <div class="d-flex">
                                            <select name="ordenar" class="form-control mr-2">
                                                <option value="">Seleccionar</option>

                                                <option value="asc"
                                                    {{ request('ordenar') == 'asc' ? 'selected' : '' }}>
                                                    Menor a Mayor
                                                </option>

                                                <option value="desc"
                                                    {{ request('ordenar') == 'desc' ? 'selected' : '' }}>
                                                    Mayor a Menor
                                                </option>
                                            </select>

                                            <button type="submit" class="btn btn-primary">
                                                Filtrar
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- BUSCADOR PRODUCTOS -->
                                <div class="col-md-4 mb-2">
                                    <form method="GET" action="{{ route('articulos.index') }}">
                                        <label>Buscar Producto:</label>

                                        <div class="d-flex">
                                            <input type="text" name="buscar" class="form-control mr-2"
                                                placeholder="Código o descripción..." value="{{ request('buscar') }}">

                                            <button type="submit" class="btn btn-primary">
                                                Buscar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @can('stocks importar')
                                    <!-- IMPORTAR EXCEL -->
                                    <div class="col-md-4 text-md-right">
                                        <form id="import-form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="archivo" id="file" class="form-control mb-2"
                                                required>
                                            <button type="button" id="btn-import" class="btn btn-success">
                                                <i class="fas fa-file-excel"></i> Importar Excel
                                            </button>

                                            <input type="file" id="excelFile" accept=".xlsx,.xls,.csv"
                                                style="display:none;">
                                        </form>
                                    </div>
                                @endcan

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <table class="table table-striped table-bordered table-hover" id="articulos-table">
                <thead class="thead-dark">
                    <tr>
                        <th class="producto text-center" style="width:5%;">#</th>
                        <th class="producto text-center" style="width:9%;">Código</th>
                        <th class="producto text-left" style="width:33%;">Descripción</th>
                        <th class="producto text-center" style="width:12%;">Costo</th>
                        <th class="producto text-center" style="width:12%;">Venta</th>
                        <th class="producto text-center" style="width:5%;">IVA</th>
                        <th colspan="3" class="text-center" style="width:5%;">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo)
                        <tr>
                            <td class="producto">{{ $articulo->id_articulo }}</td>
                            <td class="producto_descri">{{ $articulo->art_codigo }}</td>
                            <td class="producto_descri">{{ $articulo->art_descripcion }}</td>
                            <td class="producto">{{ number_format($articulo->art_precio, 0, ',', '.') }}</td>
                            <td class="producto">{{ number_format($articulo->prec_vent, 0, ',', '.') }}</td>
                            <td class="producto">{{ $articulo->art_iva }}%</td>
                            <td style="width: 150px" class="text-center">
                                {!! Form::open([
                                    'route' => ['articulos.destroy', $articulo->id_articulo],
                                    'method' => 'delete',
                                    'class' => 'd-inline',
                                ]) !!}
                                <div class='btn-group'>
                                    @can('articulos edit')
                                        <a href="{{ route('articulos.edit', [$articulo->id_articulo]) }}"
                                            class='btn btn-info btn-sx' title="Editar">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('articulos destroy')
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sx alert-delete',
                                            'title' => 'Eliminar',
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

        <div class="card-footer clearfix bg-light">
            <div class="float-left text-muted">
                Mostrando {{ $articulos->firstItem() }} -
                {{ $articulos->lastItem() }} de
                {{ $articulos->total() }} registros
            </div>
            <div class="float-right">
                {{ $articulos->links() }}
            </div>
        </div>
    </div>

    <div id="loadingOverlayArticulos">
        <div class="loading-box">

            <div class="icon-circle">
                <i class="fas fa-file-excel"></i>
            </div>

            <h4>Importando Artículos</h4>
            <p>Procesando archivo Excel...</p>

            <div class="progress-custom">
                <div id="progressBarArticulos"></div>
            </div>

            <div id="counterArticulos">0s</div>

        </div>
    </div>

    
</body>

</html>
<!-- REEMPLAZÁ TODO TU SCRIPT POR ESTE -->

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const btnImport = document.getElementById('btn-import');
        const fileInput = document.getElementById('file');

        const loader = document.getElementById('loadingOverlayArticulos');
        const counter = document.getElementById('counterArticulos');
        const progressBar = document.getElementById('progressBarArticulos');

        let seconds = 0;
        let interval;
        let fakeProgress;

        function resetUI() {
            clearInterval(interval);
            clearInterval(fakeProgress);

            btnImport.disabled = false;
            btnImport.innerHTML = `<i class="fas fa-file-excel"></i> Importar Excel`;

            progressBar.style.width = "0%";
            loader.style.display = "none";
        }

        btnImport.addEventListener('click', async function() {

            // VALIDACIÓN
            if (!fileInput.files.length) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Seleccione un archivo',
                    text: 'Debe elegir un Excel para importar'
                });
                return;
            }

            // SHOW LOADER
            loader.style.display = 'flex';

            btnImport.disabled = true;
            btnImport.innerHTML =
                `<span class="spinner-border spinner-border-sm"></span> Importando...`;

            // contador
            seconds = 0;
            counter.innerText = "0s";

            interval = setInterval(() => {
                seconds++;
                counter.innerText = seconds + "s";
            }, 1000);

            // fake progress
            let progreso = 0;
            fakeProgress = setInterval(() => {
                if (progreso < 90) {
                    progreso += Math.random() * 6;
                    progressBar.style.width = progreso + "%";
                }
            }, 400);

            let formData = new FormData();
            formData.append('archivo', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            try {

                let response = await fetch("{{ route('articulos.importar') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                let data = await response.json();

                clearInterval(interval);
                clearInterval(fakeProgress);

                progressBar.style.width = "100%";

                setTimeout(() => {

                    resetUI();

                    if (data.success) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Importación completada',
                            text: data.message
                        }).then(() => location.reload());

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: data.message
                        });

                    }

                }, 500);

            } catch (error) {

                resetUI();

                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo completar la importación'
                });
            }

        });

    });
</script>

@push('page_css')
    <link rel="stylesheet" href="{{ asset('css/modules/articulos-table.css') }}?v=20260918-2">
@endpush
