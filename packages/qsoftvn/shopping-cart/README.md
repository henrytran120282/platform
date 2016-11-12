# Shopping Cart Laravel 5


This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require qsoftvn/shopping-cart dev-master
```

##### Service Provider

###### 5.2
```php
	Qsoftvn\ShoppingCart\ShoppingServiceProvider::class,
```

###### 5.3
```php
	Qsoftvn\ShoppingCart\ShoppingCartServiceProvider::class,
```

```php
php artisan vendor:publish --provider="Qsoftvn\ShoppingCart\ShoppingServiceProvider"
php artisan migrate
php artisan db:seed
```

> *Change uri_prefix from config/qsoftvn/shopping.php*

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Recycle Bin][https://github.com/chacbumbum]
- [All Contributors][https://github.com/henrytran120282/platform/graphs/contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
