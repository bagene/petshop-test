FROM php:8.2-cli-bullseye AS base

RUN apt-get update \
    && apt-get update -y \
    && apt-get install -y --no-install-recommends \
        curl \
        git \
        libzip-dev \
        unzip \
    && pecl install xdebug \
    && docker-php-ext-install  \
        mysqli \
        pdo_mysql \
        zip \
    && apt-get autoclean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN groupadd -g 1000 app \
    && useradd -u 1000 -g app -m app

USER app

WORKDIR /var/www/html

CMD composer install
CMD php artisan optimize:clear
CMD php artisan config:clear
CMD php artisan route:clear

CMD php artisan migrate --force

