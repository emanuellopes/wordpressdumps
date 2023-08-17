# WordPress Dumps for Laradumps project

## How to use
1. first install this package with composer
```bash
composer require emanuellopes/wordpress-dumps --dev
```

2. Override the function, this override should come first in your code, you should put before called autoload.php
```php
if (!function_exists('appBasePath')) {
    function appBasePath(): string
    {
        return apply_filters('WordPressDumps/appBasePath', get_stylesheet_directory());
    }
}

require dirname(__DIR__, 2) . '/vendor/autoload.php';
```

3. Create a .env file in your theme or plugin or in other place, you can follow the reference for laradumps.
https://laradumps.dev/get-started/configuration.html


then you can use it in your code like this
```php
ds('my-dump');
```
