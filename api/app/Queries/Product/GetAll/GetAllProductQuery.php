<?php

declare(strict_types=1);

namespace App\Queries\Product\GetAll;

use App\Shared\AbstractQuery;
use App\Shared\Traits\StaticConstructor;

final class GetAllProductQuery extends AbstractQuery
{
    use StaticConstructor;
    public function __construct(
    ) {
    }
}
