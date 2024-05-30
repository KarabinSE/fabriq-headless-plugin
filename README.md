# Fabriq CMS Headless Plugin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/karabinse/fabriq-headless-plugin.svg)](https://packagist.org/packages/karabinse/fabriq-headless-plugin)


Common functionality that is needed in most projects connnected to Fabriq CMS

## Installation

You can install the package via composer:

```bash
composer require karabinse/fabriq-headless-plugin
```


## Usage

Register the controllers to setup your API endpoints to be consumed by your front end.
```php
// ...
use Karabin\FabriqPlugin\Http\Controllers\ContactController;
// ...

// News
Route::get('news', [NewsController::class, 'index']);
Route::get('news/{slug}', [NewsController::class, 'show']);

// Contacts
Route::get('contacts', [ContactController::class, 'index']);
Route::get('contacts/{id}', [ContactController::class, 'show']);

// Menus
Route::get('menus', [MenuController::class, 'index']);
Route::get('menus/{slug}', [MenuController::class, 'show']);

// Pages
Route::get('pages/{slug}', [PageController::class, 'show']);
```

It is possible to include extra data in the response. Check out the transformers for available includes.

`HTTP GET` `/contacts?include=content,tags`

## Testing

```bash
composer test
```


## Credits

- [Albin J Nilsson](https://github.com/KarabinSE)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
