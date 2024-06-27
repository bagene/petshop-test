# PETSHOP API

## Structure:
```
- app (typical Laravel app directory with Command and Query)
  - Commands
    - **
      - **
        - *Command.php
        - *CommandHandler.php
  - Http
  - Providers
  - Queries
      - **
          - **
              - *Query.php
              - *QueryHandler.php
  - Shared
- src
  - domains
    - **
      - Contracts
      - DTO
      - Http
        - Controller
        - Requests
      - Models
      - Repositories
  - infrastructure
    - Services
      - CommandBus
      - Jwt
      - QueryBus
      - Shared
- packages
  - src
    - Bacs
- tests
  - Feature
    - Domains
    - Package
  - Integration
    - App
    - Domains
    - Infrastructure
    - Package
  - Unit
      - App
      - Domains
      - Infrastructure
      - Package
```

## Command and Queries (CQRS):

* All commands and queries are mapped to their respective handlers
* You can dispatch command or query using `CommandBusInterface` or `QueryBusInterface`
* Added helper method on base `Controller` class `dispatch()` and `ask()`
* With this, you can create Integration test on your handlers instead of just a Feature test on Controller

## Implemented Routes:

* check out implemented routes by running `docker exec -it petshop-api sh -c "php artisan route:list"`

## Running Tests and Lint (uses Larastan Level 8):

* `docker exec -it petshop-api sh -c "composer lint"`
* `docker exec -it petshop-api sh -c "php artisan test"`

## Missing due to time limitations:

# OpenApi Docs
