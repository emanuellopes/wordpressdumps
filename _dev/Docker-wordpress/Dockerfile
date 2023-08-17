FROM composer:latest as composer
FROM wordpress:cli-2.8.1-php8.1 as cli
FROM wordpress:6.2.2-php8.1-fpm-alpine as wordpress
FROM wordpress:6.2.2-php8.1-fpm-alpine as php

#install composer to allow us run tests inside the container
COPY --from=composer /usr/bin/composer /usr/bin/composer
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=wordpress /usr/src/wordpress/ ./
COPY --from=cli /usr/local/bin/wp /usr/local/bin/wp

# install wp-cli dependencies
RUN apk add --no-cache mysql-client less
