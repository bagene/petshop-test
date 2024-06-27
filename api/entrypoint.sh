#!/bin/bash
composer install

if ! [ -f .env ]; then
    echo "ENV file does not exist, generating.."
    cp .env.example .env

    php artisan key:generate
    php artisan migrate --seed
else
    php artisan migrate --force
fi

php artisan optimize
php artisan route:clear
php artisan serve --host=0.0.0.0
