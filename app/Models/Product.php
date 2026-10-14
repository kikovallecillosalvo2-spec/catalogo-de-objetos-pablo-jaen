<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    // Campos que se pueden rellenar con create()/updateOrCreate()
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'pokemon_type',
        'rarity',
        'set_name',
        'card_number',
    ];

    // El precio siempre se trata con 2 decimales
    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Accesor $product->image_url:
     * devuelve la URL de la imagen solo si el archivo existe en public/,
     * si no, null (y la vista pinta la ilustración CSS de respaldo).
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return null;
    }

    /** Accesor $product->type_slug  (p. ej. "Eléctrico" -> "electrico"), usado para clases CSS */
    public function getTypeSlugAttribute(): string
    {
        return Str::slug($this->pokemon_type);
    }

    /** Accesor $product->rarity_slug (p. ej. "Ultra Rara" -> "ultra-rara") */
    public function getRaritySlugAttribute(): string
    {
        return Str::slug($this->rarity);
    }

    /** ¿Es una carta "holo" (rareza alta)? */
    public function getIsHoloAttribute(): bool
    {
        return in_array($this->rarity, ['Ultra Rara', 'Ilustración Especial'], true);
    }

    /** Precio formateado al estilo español: 1.234,50 € */
    public function getFormattedPriceAttribute(): string
    {
        return number_format((float) $this->price, 2, ',', '.') . ' €';
    }
}
