@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>Encuentra la carta que completa tu colección</h1>
            <p>Descubre tu próxima carta favorita</p>
            <a href="#catalogo" class="btn">Ver catálogo</a>
        </div>
    </section>

    <section id="catalogo" class="container section">
        <h2>Catálogo</h2>
        @if (!empty($q))
            <p class="muted">Resultados para "{{ $q }}" ({{ $products->count() }})</p>
        @endif

        @if ($products->isEmpty())
            <p class="empty">Todavía no hay cartas en el catálogo.</p>
        @else
            <div class="grid">
                @foreach ($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </section>

    <section id="colecciones" class="container section">
        <h2>Colecciones</h2>
        <ul class="sets">
            @foreach ($products->pluck('set_name')->unique()->sort() as $setName)
                <li>{{ $setName }}</li>
            @endforeach
        </ul>
    </section>
@endsection
