<?php

namespace Infrastructure\Services\Jwt\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;
use Infrastructure\Services\Jwt\JwtManager;

class JwtServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(JwtManagerInterface::class, JwtManager::class);
        $this->app->when(JwtManager::class)
            ->needs('$domain')
            ->give(env('APP_DOMAIN'));
        $this->app->when(JwtManager::class)
            ->needs('$key')
            ->give(env('JWT_KEY'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
