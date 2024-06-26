<?php

declare(strict_types=1);

namespace Bagene\Bacs\Services;

use Bagene\Bacs\BacsStub;
use Bagene\Bacs\Contracts\BacsServiceInterface;

final class BacsService implements BacsServiceInterface
{
    public function getBacs(): array
    {
        return BacsStub::stub();
    }
}
