{{-- Portada: texto + carta destacada flotando con efecto 3D/holográfico --}}
<section class="hero">
    <div class="hero-bg" aria-hidden="true"></div>
    <div class="container hero-inner">
        <div class="hero-text reveal">
            <span class="eyebrow">⚡ Nueva temporada de cartas</span>
            <h1>Encuentra la carta que <span class="highlight">completa tu colección</span></h1>
            <p class="hero-sub">Descubre tu próxima carta favorita</p>
            <div class="hero-actions">
                <a href="#catalogo" class="btn">Explorar catálogo</a>
                <a href="#colecciones" class="btn btn-ghost">Ver colecciones</a>
            </div>
        </div>

        @if ($heroCard)
            <div class="hero-card-wrap reveal">
                <div class="tilt holo type-{{ $heroCard->type_slug }}" data-tilt>
                    @if ($heroCard->image_url)
                        <img src="{{ $heroCard->image_url }}" alt="Ilustración de {{ $heroCard->name }}">
                    @else
                        <span class="art-letter">{{ mb_substr($heroCard->name, 0, 1) }}</span>
                    @endif
                    <div class="tilt-info">
                        <strong>{{ $heroCard->name }}</strong>
                        <span>{{ $heroCard->rarity }}</span>
                    </div>
                    <div class="shine" aria-hidden="true"></div>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- Franja de estadísticas (calculadas en el controlador) --}}
<section class="stats container" aria-label="Estadísticas del catálogo">
    <div class="stat reveal"><strong>{{ $stats['cartas'] }}</strong><span>Cartas</span></div>
    <div class="stat reveal"><strong>{{ $stats['colecciones'] }}</strong><span>Colecciones</span></div>
    <div class="stat reveal"><strong>{{ $stats['tipos'] }}</strong><span>Tipos</span></div>
</section>
