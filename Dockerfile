FROM php:8.0-fpm

RUN apt-get update \
    && apt-get install -y wget git unzip libpq-dev \
    && docker-php-ext-install pdo_mysql\
    && : 'Install Node.js' \
    &&  curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs \
    && : 'Install PHP Extensions' \
    && docker-php-ext-install -j$(nproc) pdo_pgsql 

ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/lara_base1