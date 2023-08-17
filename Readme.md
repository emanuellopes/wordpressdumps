# WordPress Dumps for Laradumps project

## How to use
1. first install this package with composer
```bash
composer require emanuellopes/wordpress-dumps --dev
```

2.  if you want to override the location of env file you can always use the filter
```php
add_filter('WordpressDumps/appBasePath', function(string $path) {
    return 'another location';
});
```

3. Create a .env file in your theme or plugin or in other place, you can follow the reference for laradumps.
https://laradumps.dev/get-started/configuration.html

For Docker users, you can use the following configuration
```
DS_APP_HOST=host.docker.internal
DS_APP_PORT=9191
DS_AUTO_INVOKE_APP=true #enabled
DS_SEND_QUERIES=true #enabled
```
For default php configuration you can use the following configuration
```
DS_APP_HOST=127.0.0.1
DS_APP_PORT=9191
DS_AUTO_INVOKE_APP=true #enabled
DS_SEND_QUERIES=true #enabled
```

then you can use it in your code like this
```php
ds('my-dump');
```
