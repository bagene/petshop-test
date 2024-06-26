<?php

declare(strict_types=1);

namespace Bagene\Bacs;

use Bagene\Bacs\Query\Bacs\Get\GetBacsQuery;
use Bagene\Bacs\Query\Bacs\Get\GetBacsQueryHandler;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Services\QueryBus\Contracts\QueryBusInterface;

final class BacsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            Contracts\BacsServiceInterface::class,
            Services\BacsService::class
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/bacs.php');

        $queryBus = $this->app->make(QueryBusInterface::class);

        $queryBus->map([
            GetBacsQuery::class => GetBacsQueryHandler::class,
        ]);
    }
}
