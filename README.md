# PokéMarket

Tienda de demostración de cartas Pokémon hecha con Laravel (ejercicio académico).
Proyecto no afiliado a The Pokémon Company ni a Nintendo. **Precios ficticios.**

## Requisitos
- PHP 8.2+ (con pdo_sqlite) y Composer. En este equipo vienen con Laravel Herd:
  `C:\Users\Kiko\.config\herd\bin\php84\php.exe`
- No hace falta Node/npm: el CSS está en `public/css/pokemarket.css`.

## Puesta en marcha
```powershell
composer install
copy .env.example .env      # si no existe .env
php artisan key:generate
# Base de datos SQLite: database/database.sqlite (crear vacío si no existe)
php artisan migrate
php artisan db:seed
php artisan serve
```
Abrir http://127.0.0.1:8000

## Estructura principal
- `app/Models/Product.php` – modelo Eloquent.
- `database/migrations/*_create_products_table.php` – tabla `products`.
- `database/seeders/ProductSeeder.php` – 12 cartas de ejemplo (sin duplicar al re-ejecutar).
- `app/Http/Controllers/HomeController.php` – pasa `$products` a la vista (filtro opcional `?q=`).
- `resources/views/layouts/app.blade.php`, `partials/header.blade.php`, `partials/product-card.blade.php`, `home.blade.php`.

## Diseño e interactividad
- Imágenes oficiales (PokéAPI, uso educativo) en `public/images/pokemon/`. Si falta alguna, se muestra una ilustración CSS de respaldo (accesor `image_url` del modelo).
- `public/css/pokemarket.css`: cabecera con efecto cristal, portada con carta 3D holográfica, bordes holo para rarezas altas, diseño responsive y `prefers-reduced-motion`.
- `public/js/pokemarket.js` (JavaScript sin librerías): menú móvil, filtros por tipo y rareza, ordenación por precio/nombre, modal "Ver carta" y animaciones al hacer scroll.
- Vistas extra: `partials/hero.blade.php` y `partials/footer.blade.php`.

Créditos: Ilustraciones de PokéAPI (uso educativo). Pokémon © Nintendo/Game Freak/The Pokémon Company.
