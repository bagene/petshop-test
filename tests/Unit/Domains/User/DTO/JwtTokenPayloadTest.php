<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\User\DTO;

use Carbon\Carbon;
use Domains\User\DTO\JwtTokenPayload;
use Tests\UnitTestCase;

final class JwtTokenPayloadTest extends UnitTestCase
{
    public function testGettersReturnCorrectValues(): void
    {
        $payload = JwtTokenPayload::fromArray([
            'userId' => 1,
            'uniqueId' => 'uniqueId',
            'tokenTitle' => 'tokenTitle',
            'restrictions' => ['restrictions'],
            'permissions' => ['permissions'],
            'expiresAt' => now(),
            'lastUsedAt' => now(),
            'refreshedAt' => now(),
        ]);

        $this->assertSame(1, $payload->getUserId());
        $this->assertSame('uniqueId', $payload->getUniqueId());
        $this->assertSame('tokenTitle', $payload->getTokenTitle());
        $this->assertSame(['restrictions'], $payload->getRestrictions());
        $this->assertSame(['permissions'], $payload->getPermissions());
        $this->assertInstanceOf(Carbon::class, $payload->getExpiresAt());
        $this->assertInstanceOf(Carbon::class, $payload->getLastUsedAt());
        $this->assertInstanceOf(Carbon::class, $payload->getRefreshedAt());
    }
}
