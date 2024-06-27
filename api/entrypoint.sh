#!/bin/bash
wait-for-it 10.2.0.10:3306

composer install

if ! [ -f .env ]; then
    echo "ENV file does not exist, generating.."
    cp .env.example .env
    touch storage/logs/laravel.log

    php artisan key:generate
    php artisan migrate --seed
else
    php artisan migrate --force
fi

php artisan serve --host=0.0.0.0
