<?php

declare(strict_types=1);

namespace App\Queries\Product\Get;

use App\Shared\AbstractCommand;
use App\Shared\AbstractQuery;
use App\Shared\Traits\StaticConstructor;

final class GetProductQuery extends AbstractQuery
{
    use StaticConstructor;
    private function __construct(
        private readonly string $uuid,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
