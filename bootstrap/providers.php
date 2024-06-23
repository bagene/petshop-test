<?php

return [
    App\Providers\AppServiceProvider::class,
    Infrastructure\Services\Jwt\Providers\JwtServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
    Infrastructure\Services\CommandBus\Providers\CommandBusServiceProvider::class,
    Infrastructure\Services\QueryBus\Providers\QueryBusServiceProvider::class,
];
