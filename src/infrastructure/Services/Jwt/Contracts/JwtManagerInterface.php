<?php

declare(strict_types=1);

namespace Infrastructure\Services\Jwt\Contracts;

use Domains\User\Models\User;
use Infrastructure\Services\Jwt\DTO\TokenData;

interface JwtManagerInterface
{
    public const ALGORITHM = 'HS256';
    public const TTL = '+15 minutes';
    public const NBF = '+0 minutes';

    public function generate(User $user, int $ttl, int $nbf): string;

    public function parse(string $token): TokenData;
}
