<?php

declare(strict_types=1);

namespace Bagene\Bacs\Controllers;

use App\Http\Controllers\Controller;
use Bagene\Bacs\Query\Bacs\Get\GetBacsQuery;
use Illuminate\Http\JsonResponse;

final class BacsController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->ask(
            queryClass: GetBacsQuery::class,
            fromQuery: true,
        );
    }
}
