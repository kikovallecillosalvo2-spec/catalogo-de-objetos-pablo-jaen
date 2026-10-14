{{-- Cabecera fija con efecto "cristal" (glassmorphism) --}}
<header class="site-header" id="top">
    <div class="container header-inner">
        <a href="{{ route('home') }}" class="logo" aria-label="PokéMarket, inicio">
            <span class="logo-ball" aria-hidden="true"></span>
            Poké<span>Market</span>
        </a>

        {{-- Botón hamburguesa (solo visible en móvil) --}}
        <button class="nav-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="main-nav">
            <span></span><span></span><span></span>
        </button>

        <nav class="nav" id="main-nav" aria-label="Navegación principal">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="#catalogo">Catálogo</a>
            <a href="#colecciones">Colecciones</a>

            {{-- Búsqueda real en el servidor: GET /?q=... --}}
            <form action="{{ route('home') }}" method="GET" class="search" role="search">
                <label for="search-q" class="sr-only">Buscar carta</label>
                <input id="search-q" type="search" name="q" value="{{ $q ?? '' }}" placeholder="Buscar carta…">
                <button type="submit" aria-label="Buscar">🔍</button>
            </form>
        </nav>
    </div>
</header>
