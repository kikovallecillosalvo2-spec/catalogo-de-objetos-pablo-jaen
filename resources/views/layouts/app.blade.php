<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PokéMarket') }}</title>
    <link rel="stylesheet" href="{{ asset('css/pokemarket.css') }}">
</head>
<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} PokéMarket</p>
        <p>Proyecto de demostración no afiliado a The Pokémon Company ni a Nintendo. Precios ficticios.</p>
    </footer>
</body>
</html>
