<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Búsqueda opcional por nombre: /?q=char
        $q = trim((string) $request->query('q', ''));

        if ($q === '') {
            $products = Product::all();
        } else {
            $products = Product::where('name', 'like', '%' . $q . '%')->get();
        }

        // Datos derivados de la colección (sin más consultas a la base de datos)
        $byPrice  = $products->sortByDesc('price')->values();
        $featured = $byPrice->first();                       // carta más cara (sección "Destacada")
        $heroCard = $byPrice->get(1) ?? $featured;           // la segunda más cara, para la portada
        $types    = $products->pluck('pokemon_type')->unique()->sort()->values();
        $rarities = collect(['Común', 'Infrecuente', 'Rara', 'Ultra Rara', 'Ilustración Especial'])
                        ->filter(fn ($r) => $products->contains('rarity', $r))->values();
        $sets     = $products->groupBy('set_name')->map->count()->sortKeys();   // colección => nº cartas

        $stats = [
            'cartas'      => $products->count(),
            'colecciones' => $sets->count(),
            'tipos'       => $types->count(),
        ];

        return view('home', compact('products', 'q', 'featured', 'heroCard', 'types', 'rarities', 'sets', 'stats'));
    }
}
