# Laravel Easy CRUD
A package for adding `php artisan make:api-crud` command to Laravel 8+ and Laravel Module

## Installation
Require the package with composer using the following command:

`composer require vietnh/laravel-easy-crud --dev`

Or add the following to your composer.json's require-dev section and `composer update`

```json
"require-dev": {
          "vietnh/laravel-easy-crud": "^1.*"
}
```

In your config/app.php add VietNH\LaraEasyDev\RepositoryServiceProvider::class to the end of the providers array:
```php
'providers' => [
    ...
    VietNH\LaraEasyDev\RepositoryServiceProvider::class,
],
```

Publish Configuration
```bash
php artisan vendor:publish --provider "VietNH\LaraEasyDev\RepositoryServiceProvider"
```

## Usage
`php artisan make:api-crud {model} {--module=}`

Example:
```
php artisan make:api-crud User --module=Api
```
