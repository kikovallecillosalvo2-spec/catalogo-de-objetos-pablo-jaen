<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('home') }}" class="logo">⚡ Poké<span>Market</span></a>
        <nav class="nav">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="#catalogo">Catálogo</a>
            <a href="#colecciones">Colecciones</a>
        </nav>
        <form action="{{ route('home') }}" method="GET" class="search">
            <input type="search" name="q" value="{{ $q ?? '' }}" placeholder="Buscar carta...">
            <button type="submit">Buscar</button>
        </form>
    </div>
</header>
