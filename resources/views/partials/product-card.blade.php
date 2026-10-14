@php
    $typeIcons = [
        'Eléctrico' => '⚡', 'Fuego' => '🔥', 'Psíquico' => '🔮', 'Normal' => '⭐',
        'Fantasma' => '👻', 'Lucha' => '👊', 'Agua' => '💧', 'Siniestro' => '🌙',
        'Dragón' => '🐉', 'Planta' => '🌿',
    ];
    $typeClass = 'type-' . \Illuminate\Support\Str::slug($product->pokemon_type);
    $rarityClass = 'rarity-' . \Illuminate\Support\Str::slug($product->rarity);
@endphp
<article class="card {{ $rarityClass }}">
    <div class="card-art {{ $typeClass }}">
        @if ($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        @else
            <span class="art-icon">{{ $typeIcons[$product->pokemon_type] ?? '❔' }}</span>
            <span class="art-letter">{{ mb_substr($product->name, 0, 1) }}</span>
        @endif
    </div>
    <div class="card-body">
        <div class="card-top">
            <h3 class="card-name">{{ $product->name }}</h3>
            <span class="badge {{ $rarityClass }}">{{ $product->rarity }}</span>
        </div>
        <p class="card-type">Tipo: {{ $product->pokemon_type }}</p>
        <p class="card-desc">{{ $product->description }}</p>
        <p class="card-set">{{ $product->set_name }} · Nº {{ $product->card_number ?? '—' }}</p>
        <div class="card-footer">
            <span class="price">{{ number_format($product->price, 2, ',', '.') . ' €' }}</span>
            <a href="#" class="btn btn-small">Ver carta</a>
        </div>
    </div>
</article>
