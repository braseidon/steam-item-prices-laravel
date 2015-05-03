# Braseidon Steam Item Prices

[![Author](http://img.shields.io/badge/author-@BraSeidon-blue.svg?style=flat-square)](https://twitter.com/BraSeidon)
[![Source Code](http://img.shields.io/badge/source-braseidon/steam--item--prices--laravel-blue.svg?style=flat-square)](https://github.com/braseidon/steam-item-prices-laravel)
[![Latest Version](https://img.shields.io/github/release/braseidon/steam--item--prices--laravel.svg?style=flat-square)](https://github.com/braseidon/steam-item-prices-laravel/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/braseidon/steam-item-prices-laravel/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/braseidon/steam-item-prices-laravel/master.svg?style=flat-square)](https://travis-ci.org/braseidon/steam-item-prices-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/braseidon/steam-item-prices-laravel.svg?style=flat-square)](https://packagist.org/packages/braseidon/steam-item-prices-laravel)

[Braseidon\SteamItemPrices](https://github.com/braseidon/steam-item-prices-laravel) is a wrapper around the JSON Steam API that grabs a user's items - all packaged up for Laravel 5.

## Highlights

- Uses the fast [Steam API](http://steamcommunity.com/dev/) to fetch data
- Requires a [Steam API Key](http://steamcommunity.com/dev/apikey)
- Utilizes Laravel's Caching system
- Made specifically for use with [Laravel 5](https://github.com/laravel/laravel)
- Coded to the [PSR-2](http://www.php-fig.org/psr/psr-2/) and [PSR-4](http://www.php-fig.org/psr/psr-4/) PHP coding standards

# Installation

[Braseidon\SteamItemPrices](https://github.com/braseidon/steam-item-prices-laravel) is available via Composer:

```bash
$ composer require braseidon/steam-item-prices-laravel
```

Include the Service Provider in your app's <code>config/app.php</code>.

```php
'providers' => [
    // ...
    'Braseidon\SteamItemPrices\Support\SteamItemPricesServiceProvider',
];
```

## Documentation

Documentation will be finished when v1.0.0 is up.

## Contributing

Contributions are more than welcome and will be fully credited.

## Security

If you discover any security related issues, please email brandon@poseidonwebstudios.com instead of using the issue tracker.

## Credits

- [Brandon Johnson](https://github.com/braseidon)
- [All Contributors](https://github.com/braseidon/steam-item-prices-laravel/graphs/contributors)

## License

The MIT License (MIT). Please see [LICENSE](https://github.com/braseidon/steam-item-prices-laravel/blob/master/LICENSE) for more information.