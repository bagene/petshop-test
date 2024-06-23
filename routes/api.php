<?php

declare(strict_types=1);

use Domains\User\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('create', [AdminController::class, 'create']);
    });
});
