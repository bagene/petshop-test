<?php

declare(strict_types=1);

namespace Infrastructure\Services\Jwt\DTO;

use App\Shared\AbstractDTO;
use App\Shared\Traits\StaticConstructor;

final class TokenData extends AbstractDTO
{
    use StaticConstructor;
    private function __construct(
        private readonly string $iss,
        private readonly int $exp,
        private readonly int $nbf,
        private readonly string $userUuid,
    ) {
    }

    public function getIss(): string
    {
        return $this->iss;
    }

    public function getExp(): int
    {
        return $this->exp;
    }

    public function getNbf(): int
    {
        return $this->nbf;
    }

    public function getUserUuid(): string
    {
        return $this->userUuid;
    }
}
