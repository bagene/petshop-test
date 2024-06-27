
# PETSHOP Test

## Requirements:
* Docker
* Docker Compose

## Installation:

1. Build and run by running the command `docker-compose -p "petshop" -f docker-compose.yaml up -d --build`

## Linting and Tests

* Backend Lint - `docker exec -it petshop-api sh -c "composer lint"`
* Backend Test - `docker exec -it petshop-api sh -c "php artisan test"`
* Frontend Test - `docker exec -it petshop-fe sh -c "yarn test"`

## Directory Structure

* Nuxt App - ./fe
* Laravel App - ./api
* Detailed Documentations on respective directories
