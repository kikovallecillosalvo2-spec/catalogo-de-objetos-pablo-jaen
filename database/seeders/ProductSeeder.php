<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Cartas de demostración.
     * IMPORTANTE: los precios son FICTICIOS, solo para la demo; no reflejan el mercado real.
     * Imágenes: ilustraciones oficiales descargadas de PokéAPI en public/images/pokemon/{slug}.png
     * (uso educativo). Si faltara un archivo, la vista muestra una ilustración CSS de respaldo.
     */
    public function run(): void
    {
        $cards = [
            ['name' => 'Pikachu', 'pokemon_type' => 'Eléctrico', 'rarity' => 'Común', 'set_name' => 'Colección Demo Relámpago', 'card_number' => '025/120', 'price' => 4.50, 'description' => 'Ratón eléctrico siempre listo para soltar una descarga.'],
            ['name' => 'Charizard', 'pokemon_type' => 'Fuego', 'rarity' => 'Ilustración Especial', 'set_name' => 'Colección Demo Llamarada', 'card_number' => '006/120', 'price' => 189.99, 'description' => 'Dragón de fuego cuyas llamas se ven desde las montañas.'],
            ['name' => 'Mewtwo', 'pokemon_type' => 'Psíquico', 'rarity' => 'Ultra Rara', 'set_name' => 'Colección Demo Mente Oculta', 'card_number' => '150/120', 'price' => 74.00, 'description' => 'Poder psíquico inmenso encerrado en una carta brillante.'],
            ['name' => 'Mew', 'pokemon_type' => 'Psíquico', 'rarity' => 'Rara', 'set_name' => 'Colección Demo Mente Oculta', 'card_number' => '151/120', 'price' => 39.95, 'description' => 'Juguetón y misterioso, aparece cuando menos lo esperas.'],
            ['name' => 'Eevee', 'pokemon_type' => 'Normal', 'rarity' => 'Común', 'set_name' => 'Colección Demo Relámpago', 'card_number' => '133/120', 'price' => 2.75, 'description' => 'Pequeño y adaptable, con muchos caminos por delante.'],
            ['name' => 'Gengar', 'pokemon_type' => 'Fantasma', 'rarity' => 'Rara', 'set_name' => 'Colección Demo Sombras Nocturnas', 'card_number' => '094/120', 'price' => 22.40, 'description' => 'Sonríe desde las sombras mientras planea su próxima broma.'],
            ['name' => 'Lucario', 'pokemon_type' => 'Lucha', 'rarity' => 'Infrecuente', 'set_name' => 'Colección Demo Aura Firme', 'card_number' => '448/120', 'price' => 8.90, 'description' => 'Lee el aura de sus rivales para anticipar cada golpe.'],
            ['name' => 'Gyarados', 'pokemon_type' => 'Agua', 'rarity' => 'Infrecuente', 'set_name' => 'Colección Demo Marea Alta', 'card_number' => '130/120', 'price' => 11.25, 'description' => 'Furia marina capaz de levantar tormentas enteras.'],
            ['name' => 'Umbreon', 'pokemon_type' => 'Siniestro', 'rarity' => 'Ilustración Especial', 'set_name' => 'Colección Demo Sombras Nocturnas', 'card_number' => '197/120', 'price' => 145.00, 'description' => 'Sus anillos brillan bajo la luna llena.'],
            ['name' => 'Rayquaza', 'pokemon_type' => 'Dragón', 'rarity' => 'Ultra Rara', 'set_name' => 'Colección Demo Cielo Esmeralda', 'card_number' => '384/120', 'price' => 96.50, 'description' => 'Guardián de los cielos que surca la capa de ozono.'],
            ['name' => 'Greninja', 'pokemon_type' => 'Agua', 'rarity' => 'Rara', 'set_name' => 'Colección Demo Marea Alta', 'card_number' => '658/120', 'price' => 27.80, 'description' => 'Ninja acuático veloz que lanza estrellas de agua.'],
            ['name' => 'Bulbasaur', 'pokemon_type' => 'Planta', 'rarity' => 'Común', 'set_name' => 'Colección Demo Cielo Esmeralda', 'card_number' => '001/120', 'price' => 3.20, 'description' => 'Lleva una semilla a la espalda que crece con el sol.'],
        ];

        foreach ($cards as $card) {
            // Ruta relativa a public/, p. ej. images/pokemon/charizard.png
            $card['image'] = 'images/pokemon/' . Str::slug($card['name']) . '.png';

            // updateOrCreate por nombre + colección: volver a ejecutar no duplica, solo actualiza.
            Product::updateOrCreate(
                ['name' => $card['name'], 'set_name' => $card['set_name']],
                $card
            );
        }
    }
}
