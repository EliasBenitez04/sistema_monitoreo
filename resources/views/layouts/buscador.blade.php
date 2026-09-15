<form id="form-busqueda" method="GET" action="{{ $url }}" class="sm-search-form mb-3">
    <div class="input-group sm-search-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-search" aria-hidden="true"></i>
            </span>
        </div>

        <input
            type="search"
            class="form-control buscar"
            name="buscar"
            value="{{ request()->get('buscar', '') }}"
            placeholder="Buscar registros..."
            data-url="{{ $url }}"
            aria-label="Buscar registros">

        <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submit">
                Buscar
            </button>
        </div>
    </div>
</form>
