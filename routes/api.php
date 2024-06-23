<?php

declare(strict_types=1);

use App\Http\Middleware\AuthJwt;
use Domains\User\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware([AuthJwt::class])->group(function () {
            Route::post('create', [AdminController::class, 'create']);
        });
        Route::post('login', [AdminController::class, 'login']);
    });
});
