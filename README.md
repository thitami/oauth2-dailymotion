# DailyMotion Provider for OAuth 2.0 Client

This package provides DailyMotion OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

This package is compliant with [PSR-1][], [PSR-2][], [PSR-4][], and [PSR-7][]. If you notice compliance oversights,
please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
[PSR-7]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-7-http-message.md

## Requirements

The following versions of PHP are supported.

* PHP 5.5
* PHP 5.6
* PHP 7.0
* HHVM

## Installation

To install, use composer:

```
composer require thitami/oauth2-dailymotion
```

## Usage


Usage is the same as The League's OAuth client, just use `Thitami\OAuth2\Client\Provider\DailyMotion` as the provider. Please refer to [core package documentation on "Authorization Code Grant"](https://github.com/thephpleague/oauth2-client#usage) for more information.

## Testing

```
$ ./vendor/bin/phpunit
```

## Credits

- [Theodoros Moschos](https://github.com/thitami)
- [All Contributors](https://github.com/thitami/oauth2-dailymotion/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/thitami/oauth2-dailymotion/blob/master/LICENSE) for more information.