<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\User\DTO;

use Domains\User\DTO\UserPayload;
use Tests\UnitTestCase;

final class UserPayloadTest extends UnitTestCase
{
    public function testGettersReturnCorrectValues(): void
    {
        $userPayload = UserPayload::fromArray([
            'uuid' => 'uuid',
            'first_name' => 'firstName',
            'last_name' => 'lastName',
            'is_admin' => true,
            'email' => 'test@example.org',
            'password' => 'password',
            'address' => 'address',
            'phone_number' => 'phoneNumber',
            'is_marketing' => true,
            'avatar' => 'avatar',
        ]);

        $this->assertSame('uuid', $userPayload->getUuid());
        $this->assertSame('firstName', $userPayload->getFirstName());
        $this->assertSame('lastName', $userPayload->getLastName());
        $this->assertTrue($userPayload->isAdmin());
        $this->assertSame('test@example.org', $userPayload->getEmail());
        $this->assertSame('password', $userPayload->getPassword());
        $this->assertSame('address', $userPayload->getAddress());
        $this->assertSame('phoneNumber', $userPayload->getPhoneNumber());
        $this->assertTrue($userPayload->getIsMarketing());
        $this->assertSame('avatar', $userPayload->getAvatar());
    }
}
