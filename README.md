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
