<div class="row">
    <div class="col-lg-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title mb-0">Información general</h3>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Fecha de carga</dt>
                    <dd class="col-sm-7">{{ CarbonCarbon::parse($foto->fot_fecha)->format('d/m/Y') }}</dd>

                    <dt class="col-sm-5">N° OT</dt>
                    <dd class="col-sm-7">{{ $foto->fot_ot }}</dd>

                    <dt class="col-sm-5">Precio costo</dt>
                    <dd class="col-sm-7">{{ number_format($foto->fot_costo, 0, ',', '.') }} Gs.</dd>

                    <dt class="col-sm-5">Precio venta</dt>
                    <dd class="col-sm-7">{{ number_format($foto->fot_venta, 0, ',', '.') }} Gs.</dd>

                    <dt class="col-sm-5">Artículo</dt>
                    <dd class="col-sm-7">{{ $foto->fot_desc }}</dd>

                    <dt class="col-sm-5">Línea</dt>
                    <dd class="col-sm-7">{{ $foto->linea->linea_desc ?? $foto->linea_cod }}</dd>

                    <dt class="col-sm-5">Usuario</dt>
                    <dd class="col-sm-7">{{ $foto->user->name ?? $foto->user_id }}</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title mb-0">Imagen</h3>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center text-center">
                @if ($foto->fot_img)
                    <img
                        src="{{ Storage::url('fotos/' . $foto->fot_img) }}"
                        alt="Imagen asociada a la OT {{ $foto->fot_ot }}"
                        class="img-fluid sm-photo-image img-clickable">
                @else
                    <div class="sm-empty-state">
                        <i class="fas fa-image"></i>
                        <p class="mb-0">No hay imagen disponible.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if ($foto->fot_img)
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vista ampliada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="modalImage" class="img-fluid" alt="Vista ampliada">
                </div>
            </div>
        </div>
    </div>
@endif

@push('page_scripts')
    <script>
        $(function () {
            $('.img-clickable').on('click', function () {
                $('#modalImage').attr('src', this.src);
                $('#imageModal').modal('show');
            });
        });
    </script>
@endpush
