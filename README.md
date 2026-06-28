# Number Normalizer 🌍

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devhamidshahbazi/number-normalizer.svg)](https://packagist.org/packages/devhamidshahbazi/number-normalizer)
[![Total Downloads](https://img.shields.io/packagist/dt/devhamidshahbazi/number-normalizer.svg)](https://packagist.org/packages/devhamidshahbazi/number-normalizer)
[![License](https://img.shields.io/packagist/l/devhamidshahbazi/number-normalizer.svg)](https://github.com/DevHamidShahbazi/number-normalizer/blob/main/LICENSE)

**Laravel package to automatically normalize any non-English digits to English numbers in all requests.**

## ✨ Features

- 🌍 **14 Languages Supported** - Persian, Arabic, Urdu, Hindi, Bengali, Gujarati, Thai, Khmer, Lao, Myanmar, Chinese, Japanese, Korean, Spanish
- 🚀 **Auto Middleware** - Automatically normalizes all incoming requests
- ⚙️ **Fully Configurable** - Add custom languages, exclude routes, choose language combinations
- 🔌 **Extensible** - Easy to add new languages via config or code
- 🎯 **Zero Configuration** - Works out of the box with Persian and Arabic

## 📦 Installation

```bash
composer require devhamidshahbazi/number-normalizer
```

Publish the config file:

```bash
php artisan vendor:publish --tag=number-normalizer-config
```

## 🌍 Supported Languages

### Languages with Custom Digits (10 Languages)

| # | Language | Digits | Example |
|---|----------|--------|---------|
| 1 | **Persian** | `۰۱۲۳۴۵۶۷۸۹` | `۱۲۳` → `123` |
| 2 | **Arabic** | `٠١٢٣٤٥٦٧٨٩` | `١٢٣` → `123` |
| 3 | **Urdu** | `۰۱۲۳۴۵۶۷۸۹` | `۱۲۳` → `123` |
| 4 | **Hindi** | `०१२३४५६७८९` | `१२३` → `123` |
| 5 | **Bengali** | `০১২৩৪৫৬৭৮৯` | `১২৩` → `123` |
| 6 | **Gujarati** | `૦૧૨૩૪૫૬૭૮૯` | `૧૨૩` → `123` |
| 7 | **Thai** | `๐๑๒๓๔๕๖๗๘๙` | `๑๒๓` → `123` |
| 8 | **Khmer** | `០១២៣៤៥៦៧៨៩` | `១២៣` → `123` |
| 9 | **Lao** | `໐໑໒໓໔໕໖໗໘໙` | `໑໒໓` → `123` |
| 10 | **Myanmar** | `၀၁၂၃၄၅၆၇၈၉` | `၁၂၃` → `123` |

## ⚙️ Configuration

File: `config/number-normalizer.php`

```php
// Active languages (merged and applied together)
'combined_languages' => [
    'persian',
    'arabic',
    'urdu',
    'hindi',
    'bengali',
    'gujarati',
    'thai',
    'khmer',
    'lao',
    'myanmar',
],

// Built-in mappings (complete for all 14 languages)
'mappings' => [
    'persian' => ['۰' => '0', '۱' => '1', '۲' => '2', /* ... */],
    'arabic'  => ['٠' => '0', '١' => '1', '٢' => '2', /* ... */],
    'urdu'    => ['۰' => '0', '۱' => '1', '۲' => '2', /* ... */],
    'hindi'   => ['०' => '0', '१' => '1', '२' => '2', /* ... */],
    'bengali' => ['০' => '0', '১' => '1', '২' => '2', /* ... */],
    'gujarati'=> ['૦' => '0', '૧' => '1', '૨' => '2', /* ... */],
    'thai'    => ['๐' => '0', '๑' => '1', '๒' => '2', /* ... */],
    'khmer'   => ['០' => '0', '១' => '1', '២' => '2', /* ... */],
    'lao'     => ['໐' => '0', '໑' => '1', '໒' => '2', /* ... */],
    'myanmar' => ['၀' => '0', '၁' => '1', '၂' => '2', /* ... */],
],

// Custom languages (add your own)
'custom_mappings' => [
    // 'tamil' => ['௦' => '0', '௧' => '1', /* ... */],
],

// Excluded routes (not normalized)
'except' => [
    'api/webhook',
    'admin/*',
],
```

## 🚀 Adding a New Language

To add a new language:

1. Define the mapping in `custom_mappings`:
```php
'custom_mappings' => [
    'tamil' => [
        '௦' => '0', '௧' => '1', '௨' => '2', '௩' => '3',
        '௪' => '4', '௫' => '5', '௬' => '6', '௭' => '7',
        '௮' => '8', '௯' => '9',
    ],
],
```

2. Add the language name to `combined_languages`:
```php
'combined_languages' => [
    'persian', 'arabic', 'tamil', // Add your new language
],
```

## 🛠️ Middleware

By default, middleware is **automatically** added to all requests (`auto_middleware => true`).

To disable auto-registration and register manually:

```php
// config/number-normalizer.php
'auto_middleware' => false,
```

Then in `app/Http/Kernel.php`:

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

## 💻 Manual Usage

```php
use NumberNormalizer\Facades\NumberNormalizer;

// Convert all supported languages
NumberNormalizer::toEnglish('قیمت: ۱۲۳۴ و ๑๒๓'); // قیمت: 1234 و 123

// Specific languages only
NumberNormalizer::toEnglish('۱۲۳ و ١٢٣', ['persian', 'arabic']);

// Custom mapping
NumberNormalizer::withMapping('۱۲۳', ['۱' => '1', '۲' => '2', '۳' => '3']);
```

## 🎯 Use Cases

- 🌐 **Multi-language applications** - Normalize numbers from users worldwide
- 📱 **International forms** - Phone numbers, national IDs, amounts
- 💰 **E-commerce** - Currency amounts from different regions
- 🏦 **Financial systems** - Standardize numerical inputs
- 📊 **Data processing** - Clean and normalize data from various sources

## 📊 Language Coverage by Region

| Region | Languages |
|--------|-----------|
| **Middle East** | Persian, Arabic, Urdu |
| **South Asia** | Hindi, Bengali, Gujarati |
| **Southeast Asia** | Thai, Khmer, Lao, Myanmar |
| **Europe** | Spanish |

## 📝 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## ⭐ Support

If you find this package helpful, please give it a ⭐ on [GitHub](https://github.com/DevHamidShahbazi/number-normalizer)!