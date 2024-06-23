<?php

declare(strict_types=1);

use App\Http\Middleware\AuthJwt;
use Domains\User\Http\Controllers\AdminController;
use Domains\User\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('api')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware([AuthJwt::class])->group(function () {
            Route::post('create', [AdminController::class, 'create']);
        });
        Route::post('login', [AdminController::class, 'login']);
        Route::delete('logout', [AdminController::class, 'logout']);
    });

    Route::prefix('user')->group(function () {
        Route::middleware([AuthJwt::class])->group(function () {
            Route::get('/', [AuthController::class, 'me']);
        });

        Route::post('login', [AuthController::class, 'login']);
        Route::delete('logout', [AuthController::class, 'logout']);
    });
});
