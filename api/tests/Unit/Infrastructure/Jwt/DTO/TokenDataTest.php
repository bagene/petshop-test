<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Jwt\DTO;

use Infrastructure\Services\Jwt\DTO\TokenData;
use Tests\UnitTestCase;

final class TokenDataTest extends UnitTestCase
{
    public function testGettersReturnCorrectValues(): void
    {
        $tokenData = TokenData::fromArray([
            'iss' => 'iss',
            'exp' => 1,
            'nbf' => 2,
            'userUuid' => 'userUuid',
        ]);

        $this->assertSame('iss', $tokenData->getIss());
        $this->assertSame(1, $tokenData->getExp());
        $this->assertSame(2, $tokenData->getNbf());
        $this->assertSame('userUuid', $tokenData->getUserUuid());
    }
}
