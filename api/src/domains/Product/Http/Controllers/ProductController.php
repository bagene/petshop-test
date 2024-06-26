<?php

declare(strict_types=1);

namespace Domains\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Queries\Product\Get\GetProductQuery;
use App\Queries\Product\GetAll\GetAllProductQuery;
use Illuminate\Http\JsonResponse;

final class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->ask(GetAllProductQuery::class, false, true);
    }

    public function show(): JsonResponse
    {
        return $this->ask(
            queryClass: GetProductQuery::class,
            fromQuery: true,
        );
    }
}
