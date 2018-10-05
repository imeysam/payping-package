# payping-package for Laravel 5

[![Issues](https://img.shields.io/github/issues/ameysam/payping-package.svg?style=flat-square)](https://github.com/ameysam/payping-package/issues)
[![Forks](https://img.shields.io/github/forks/ameysam/payping-package.svg?style=flat-square)](https://github.com/ameysam/payping-package/network/members)
[![Stars](https://img.shields.io/github/stars/ameysam/payping-package.svg?style=flat-square)](https://github.com/ameysam/payping-package/stargazers)

## Installation

The PayPing Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`ameysam/payping` package and setting the `minimum-stability` to `dev` (required for Laravel 5) in your
project's `composer.json`.

```json
{
    "require": {
        "ameysam/payping": "^1.1.0"
    }
}
```

or

Require this package with composer:

```
composer require ameysam/payping
```

Update your packages with ```composer update``` or install with ```composer install```.


Find the `providers` key in `config/app.php` and register the PayPing Service Provider.

for Laravel 5.1+
```php
    'providers' => [
        // ...
        AMeysam\PayPing\PayPingServiceProvider::class,
    ]
```
for Laravel 5.0
```php
    'providers' => [
        // ...
        'AMeysam\PayPing\PayPingServiceProvider',
    ]
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider="AMeysam\PayPing\PayPingServiceProvider"
```

> After publish the package files you must open payping.php in config folder and set the token value.
> 

> **Like this:**

	'token' => env('PAYPING_TOKEN', 'payping token (get by calling getToken method.)'),
    
>   
    
>
> Note: You can set return url for after payment to redirect them or you can pass return url to requestToken method.
> **like this:**
>

    'return-url' => env('PAYPING_RETURN_URL', 'your return url after payment'),
    
    or
    
    $body['returnUrl'] = 'http://your-url';
    PayPing::requestToken($body);
    
>

you can set the keys and line number in your .env file

> **like this:**

> PAYPING_TOKEN=token

> PAYPING_RETURN_URL=http://your.url
