<?php

use Bagene\Bacs\Controllers\BacsController;
use Illuminate\Support\Facades\Route;

Route::get('/api/v1/bacs', BacsController::class);
