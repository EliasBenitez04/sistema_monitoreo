<div class="sm-table-toolbar">
    <div class="row align-items-end">
        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
            <form method="GET" action="{{ route('articulos.index') }}">
                <label for="ordenar-articulos">Ordenar por precio</label>
                <div class="input-group">
                    <select name="ordenar" id="ordenar-articulos" class="form-control">
                        <option value="">Sin orden específico</option>
                        <option value="asc" {{ request('ordenar') == 'asc' ? 'selected' : '' }}>Menor a mayor</option>
                        <option value="desc" {{ request('ordenar') == 'desc' ? 'selected' : '' }}>Mayor a menor</option>
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary">Aplicar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
            <form method="GET" action="{{ route('articulos.index') }}">
                <label for="buscar-articulos">Buscar producto</label>
                <div class="input-group">
                    <input type="text" name="buscar" id="buscar-articulos" class="form-control"
                        placeholder="Código o descripción" value="{{ request('buscar') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i>
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @can('stocks importar')
            <div class="col-lg-4 col-md-12">
                <form id="import-form" enctype="multipart/form-data">
                    @csrf
                    <label for="file">Importar catálogo</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="archivo" id="file" class="custom-file-input"
                                accept=".xlsx,.xls,.csv" required>
                            <label class="custom-file-label" for="file">Seleccionar archivo</label>
                        </div>
                        <div class="input-group-append">
                            <button type="button" id="btn-import" class="btn btn-success">
                                <i class="fas fa-file-excel"></i>
                                Importar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endcan
    </div>
</div>

<div class="table-responsive">
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
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const btnImport = document.getElementById('btn-import');
        const fileInput = document.getElementById('file');

        const loader = document.getElementById('loadingOverlayArticulos');
        const counter = document.getElementById('counterArticulos');
        const progressBar = document.getElementById('progressBarArticulos');

        if (!btnImport || !fileInput || !loader || !counter || !progressBar) {
            return;
        }

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
    <link rel="stylesheet" href="{{ asset('css/modules/articulos-table.css') }}?v=20260918-4">
@endpush
