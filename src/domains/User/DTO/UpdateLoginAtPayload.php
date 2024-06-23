<?php

declare(strict_types=1);

namespace Domains\User\DTO;

use App\Shared\AbstractDTO;
use App\Shared\Traits\StaticConstructor;
use Carbon\Carbon;

final class UpdateLoginAtPayload extends AbstractDTO
{
    use StaticConstructor;
    public function __construct(
        private readonly Carbon $lastLoginAt,
    ) {
    }

    public function getLastLoginAt(): Carbon
    {
        return $this->lastLoginAt;
    }
}
