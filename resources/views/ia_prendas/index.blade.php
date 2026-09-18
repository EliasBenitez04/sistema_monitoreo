@extends('layouts.app')

@section('title', 'Procesador de imágenes IA | ' . config('app.name'))

@section('content')
    <x-page-header
        title="Procesador de imágenes"
        subtitle="Elimine fondos y genere imágenes procesadas por lote."
        icon="fas fa-magic">
        <a href="{{ route('ia.descargar') }}" class="btn btn-default">
            <i class="fas fa-download"></i>
            Descargar ZIP
        </a>
    </x-page-header>

    <div class="content px-3">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @if (session('log'))
                <pre class="small bg-light border rounded p-3">{{ print_r(session('log'), true) }}</pre>
            @endif
        @endif

        <div class="card sm-form-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title mb-0">Nuevo procesamiento</h3>
                    <small class="text-muted">Seleccione una o más imágenes y, si desea, un fondo de temporada.</small>
                </div>
            </div>

            <form id="formIA" method="POST" action="{{ route('ia.subir') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="imagenes">Imágenes</label>
                        <input type="file" id="imagenes" name="imagenes[]" class="form-control"
                            multiple accept="image/*" required>
                    </div>

                    <div class="form-group mb-0">
                        <label for="estilo">Fondo opcional</label>
                        <select name="estilo" id="estilo" class="form-control">
                            <option value="">Sin fondo adicional</option>
                            <option value="verano">Verano</option>
                            <option value="invierno">Invierno</option>
                            <option value="otoño">Otoño</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" id="btnIA" class="btn btn-primary">
                        <i class="fas fa-magic"></i>
                        Procesar imágenes
                    </button>
                </div>
            </form>
        </div>

        @if (session('preview_ia'))
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title mb-0">Vista previa</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach (session('preview_ia') as $img)
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="border rounded p-2 h-100">
                                    <small class="text-muted d-block mb-1">Original</small>
                                    <img src="{{ $img['original'] }}" class="sm-ia-preview mb-3" alt="Imagen original">

                                    <small class="text-success d-block mb-1">Procesada</small>
                                    <img src="{{ $img['procesada'] }}" class="sm-ia-preview mb-3" alt="Imagen procesada">

                                    @if (!empty($img['final']))
                                        <small class="text-primary d-block mb-1">Final</small>
                                        <img src="{{ $img['final'] }}" class="sm-ia-preview" alt="Imagen final">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div id="loadingOverlay" class="sm-ia-overlay">
        <div class="sm-ia-overlay__panel">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="sr-only">Procesando...</span>
            </div>
            <h4>Procesando imágenes</h4>
            <p class="text-muted mb-0">El proceso puede tardar algunos segundos.</p>
            <div class="sm-ia-progress">
                <div id="progressBar" class="sm-ia-progress__bar"></div>
            </div>
            <strong id="counter">0s</strong>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        document.getElementById('formIA')?.addEventListener('submit', function () {
            const overlay = document.getElementById('loadingOverlay');
            const button = document.getElementById('btnIA');
            const counter = document.getElementById('counter');
            const progressBar = document.getElementById('progressBar');

            overlay.style.display = 'flex';
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Procesando...';

            let seconds = 0;
            let progress = 0;

            counter.innerText = '0s';
            progressBar.style.width = '0%';

            window.setInterval(function () {
                seconds += 1;
                counter.innerText = seconds + 's';
            }, 1000);

            window.setInterval(function () {
                if (progress < 90) {
                    progress += Math.random() * 8;
                    progressBar.style.width = Math.min(progress, 90) + '%';
                }
            }, 500);
        });
    </script>
@endpush
