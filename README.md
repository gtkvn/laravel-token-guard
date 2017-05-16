# Laravel Token Guard

Extends default Laravel token guard to retrieve users from cookies.

## Installation

To get started with Laravel Token Guard, add to your `composer.json` file as a dependency:

    composer require gtk/laravel-token-guard
    
## Configuration

After installing the Laravel Token Guard library, register the `Gtk\LaravelTokenGuard\ServiceProvider` in your `config/app.php` configuration file:

```php
'providers' => [
    // Other service providers...
    
    Gtk\LaravelTokenGuard\ServiceProvider::class,
];
```
