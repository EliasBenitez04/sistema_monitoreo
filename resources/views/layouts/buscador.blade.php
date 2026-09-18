@php($searchUrl = $url ?? url()->current())
@php($searchTarget = $target ?? '.tabla-container')

<form method="GET" action="{{ $searchUrl }}" class="sm-search-form">
    <div class="input-group sm-search-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-search" aria-hidden="true"></i>
            </span>
        </div>

        <input
            type="search"
            class="form-control buscar js-remote-search"
            name="buscar"
            value="{{ request()->get('buscar', '') }}"
            placeholder="{{ $placeholder ?? 'Buscar registros...' }}"
            data-url="{{ $searchUrl }}"
            data-param="buscar"
            data-target="{{ $searchTarget }}"
            aria-label="Buscar registros">

        <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submit">
                Buscar
            </button>
        </div>
    </div>
</form>
