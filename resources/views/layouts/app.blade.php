<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PokéMarket: catálogo de demostración de cartas Pokémon.">
    <title>{{ config('app.name', 'PokéMarket') }} · Cartas Pokémon</title>

    {{-- Fuente de Google (Outfit) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&display=swap" rel="stylesheet">

    {{-- CSS propio, sin Vite ni npm --}}
    <link rel="stylesheet" href="{{ asset('css/pokemarket.css') }}">
</head>
<body>
    <a class="skip-link" href="#catalogo">Saltar al catálogo</a>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- JavaScript propio: filtros, orden, modal, efecto 3D y animaciones --}}
    <script src="{{ asset('js/pokemarket.js') }}" defer></script>
</body>
</html>
