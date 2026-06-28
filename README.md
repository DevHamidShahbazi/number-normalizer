# Number Normalizer

A Laravel package that automatically converts non-English digits to English in all HTTP requests.

## Installation

```bash
composer require devhamidshahbazi/number-normalizer
```

Publish the config file:

```bash
php artisan vendor:publish --tag=number-normalizer-config
```

## Configuration

File: `config/number-normalizer.php`

```php
// Languages whose mappings are merged together
'combined_languages' => ['persian', 'arabic'],

// Built-in mappings (Persian and Arabic)
'mappings' => [
    'persian' => ['۰' => '0', '۱' => '1', ...],
    'arabic'  => ['٠' => '0', '١' => '1', ...],
],

// Your custom languages
'custom_mappings' => [
    'urdu' => ['۰' => '0', '۱' => '1', ...],
],

// Excluded routes
'except' => [
    'api/webhook',
    'admin/*',
],
```

To add a new language:
1. Define the mapping in `custom_mappings`
2. Add the language name to `combined_languages`

## Middleware

By default, middleware is **automatically** added to all requests (`auto_middleware => true`).

To disable auto-registration and register manually:

```php
// config/number-normalizer.php
'auto_middleware' => false,
```

Then in `app/Http/Kernel.php` (Laravel 5.*):

```php
protected $middleware = [
    // ...
    \NumberNormalizer\Http\Middleware\NormalizeNumbers::class,
];
```

Or apply only to specific routes:

```php
Route::post('/register', ...)->middleware('normalize.numbers');
```

## Manual Usage

```php
use NumberNormalizer\Facades\NumberNormalizer;

NumberNormalizer::toEnglish('قیمت: ۱۲۳۴'); // قیمت: 1234

// Specific languages only
NumberNormalizer::toEnglish('۱۲۳', ['persian']);

// Custom mapping
NumberNormalizer::withMapping('۱۲۳', ['۱' => '1', '۲' => '2', '۳' => '3']);
```

## License

MIT
