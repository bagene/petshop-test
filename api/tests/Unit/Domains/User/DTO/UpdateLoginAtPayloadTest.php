<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\User\DTO;

use Carbon\Carbon;
use Domains\User\DTO\UpdateLoginAtPayload;
use Tests\UnitTestCase;

final class UpdateLoginAtPayloadTest extends UnitTestCase
{
    public function testGettersReturnCorrectValues(): void
    {
        $payload = UpdateLoginAtPayload::fromArray([
            'lastLoginAt' => now(),
        ]);

        $this->assertInstanceOf(Carbon::class, $payload->getLastLoginAt());
    }
}
