<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
    Infrastructure\Services\CommandBus\Providers\CommandBusServiceProvider::class,
    Infrastructure\Services\QueryBus\Providers\QueryBusServiceProvider::class,
];
