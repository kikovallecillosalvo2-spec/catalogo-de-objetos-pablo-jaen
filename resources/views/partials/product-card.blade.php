{{--
    Tarjeta de UNA carta. Recibe $product desde home.blade.php (@include).
    Los atributos data-* sirven para que el JavaScript filtre, ordene y abra el modal
    sin volver a pedir datos al servidor.
--}}
@php
    $typeIcons = [
        'Eléctrico' => '⚡', 'Fuego' => '🔥', 'Psíquico' => '🔮', 'Normal' => '⭐',
        'Fantasma' => '👻', 'Lucha' => '👊', 'Agua' => '💧', 'Siniestro' => '🌙',
        'Dragón' => '🐉', 'Planta' => '🌿',
    ];
    $icon = $typeIcons[$product->pokemon_type] ?? '❔';
@endphp
<article class="card reveal type-{{ $product->type_slug }} rarity-{{ $product->rarity_slug }} {{ $product->is_holo ? 'is-holo' : '' }}"
         data-name="{{ $product->name }}"
         data-type="{{ $product->pokemon_type }}"
         data-rarity="{{ $product->rarity }}"
         data-price="{{ $product->price }}"
         data-price-label="{{ $product->formatted_price }}"
         data-set="{{ $product->set_name }}"
         data-number="{{ $product->card_number ?? '—' }}"
         data-description="{{ $product->description }}"
         data-image="{{ $product->image_url ?? '' }}"
         data-icon="{{ $icon }}">

    <div class="card-art">
        <span class="type-pill">{{ $icon }} {{ $product->pokemon_type }}</span>
        @if ($product->image_url)
            <img src="{{ $product->image_url }}" alt="Ilustración de {{ $product->name }}" loading="lazy" width="475" height="475">
        @else
            {{-- Respaldo si no hay imagen: letra grande sobre degradado del tipo --}}
            <span class="art-letter" aria-hidden="true">{{ mb_substr($product->name, 0, 1) }}</span>
        @endif
    </div>

    <div class="card-body">
        <div class="card-top">
            <h3 class="card-name">{{ $product->name }}</h3>
            <span class="badge rarity-{{ $product->rarity_slug }}">{{ $product->rarity }}</span>
        </div>
        <p class="card-desc">{{ $product->description }}</p>
        <p class="card-set">{{ $product->set_name }} · Nº {{ $product->card_number ?? '—' }}</p>
        <div class="card-footer">
            <span class="price">{{ $product->formatted_price }}</span>
            {{-- Abre un modal con los detalles (no compra nada) --}}
            <button type="button" class="btn btn-small js-open-modal">Ver carta</button>
        </div>
    </div>
</article>
