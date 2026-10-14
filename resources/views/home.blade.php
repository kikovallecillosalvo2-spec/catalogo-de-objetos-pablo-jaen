@extends('layouts.app')

@section('content')
    {{-- Portada + estadísticas --}}
    @include('partials.hero')

    {{-- Carta destacada: la más cara del catálogo --}}
    @if ($featured)
        <section class="container section featured reveal" aria-labelledby="featured-title">
            <div class="featured-art type-{{ $featured->type_slug }}">
                @if ($featured->image_url)
                    <img src="{{ $featured->image_url }}" alt="Ilustración de {{ $featured->name }}">
                @endif
            </div>
            <div class="featured-text">
                <span class="eyebrow">🏆 Destacada</span>
                <h2 id="featured-title">{{ $featured->name }}</h2>
                <p>{{ $featured->description }}</p>
                <p class="muted">{{ $featured->set_name }} · Nº {{ $featured->card_number }} · {{ $featured->rarity }}</p>
                <p class="price price-big">{{ $featured->formatted_price }}</p>
            </div>
        </section>
    @endif

    {{-- Catálogo --}}
    <section id="catalogo" class="container section">
        <div class="section-head">
            <h2>Catálogo</h2>
            @if (!empty($q))
                <p class="muted">Resultados para "{{ $q }}": {{ $products->count() }} · <a href="{{ route('home') }}">Quitar búsqueda</a></p>
            @endif
        </div>

        @if ($products->isEmpty())
            <p class="empty">Todavía no hay cartas en el catálogo.</p>
        @else
            {{-- Filtros en el navegador (JavaScript) --}}
            <div class="toolbar" aria-label="Filtros">
                <div class="chips" data-filter-group="type" role="group" aria-label="Filtrar por tipo">
                    <button class="chip active" data-value="">Todos los tipos</button>
                    @foreach ($types as $type)
                        <button class="chip" data-value="{{ $type }}">{{ $type }}</button>
                    @endforeach
                </div>
                <div class="chips" data-filter-group="rarity" role="group" aria-label="Filtrar por rareza">
                    <button class="chip active" data-value="">Todas las rarezas</button>
                    @foreach ($rarities as $rarity)
                        <button class="chip" data-value="{{ $rarity }}">{{ $rarity }}</button>
                    @endforeach
                </div>
                <label class="sort">
                    <span>Ordenar:</span>
                    <select id="sort-select">
                        <option value="">Por defecto</option>
                        <option value="price-asc">Precio: menor a mayor</option>
                        <option value="price-desc">Precio: mayor a menor</option>
                        <option value="name">Nombre (A-Z)</option>
                    </select>
                </label>
            </div>

            <p class="muted results-count" aria-live="polite"><span id="visible-count">{{ $products->count() }}</span> cartas</p>

            {{-- La tarjeta se escribe UNA vez (partial) y @foreach la repite por cada producto --}}
            <div class="grid" id="card-grid">
                @foreach ($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
            <p class="empty" id="no-results" hidden>Ninguna carta coincide con los filtros.</p>
        @endif
    </section>

    {{-- Colecciones con número de cartas --}}
    <section id="colecciones" class="container section">
        <h2>Colecciones</h2>
        <div class="sets">
            @foreach ($sets as $setName => $count)
                <div class="set reveal">
                    <strong>{{ $setName }}</strong>
                    <span>{{ $count }} {{ $count === 1 ? 'carta' : 'cartas' }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Modal "Ver carta" (lo rellena el JavaScript con los data-* de la tarjeta) --}}
    <dialog class="modal" id="card-modal" aria-labelledby="modal-name">
        <button class="modal-close" aria-label="Cerrar">✕</button>
        <div class="modal-grid">
            <div class="modal-art" id="modal-art"><img id="modal-img" alt=""></div>
            <div>
                <span class="badge" id="modal-rarity"></span>
                <h3 id="modal-name"></h3>
                <p id="modal-desc"></p>
                <dl class="modal-meta">
                    <dt>Tipo</dt><dd id="modal-type"></dd>
                    <dt>Colección</dt><dd id="modal-set"></dd>
                    <dt>Número</dt><dd id="modal-number"></dd>
                </dl>
                <p class="price price-big" id="modal-price"></p>
                <p class="muted small">Tienda de demostración: no se realizan compras.</p>
            </div>
        </div>
    </dialog>
@endsection
