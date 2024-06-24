<?php

declare(strict_types=1);

namespace Tests\Unit\App\Shared\Response;

use App\Shared\Response\UserResponse;
use Tests\UnitTestCase;

final class UserResponseTest extends UnitTestCase
{
    public function testGettersReturnCorrectValues(): void
    {
        $response = UserResponse::fromArray([
            'uuid' => 'uuid',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'is_admin' => true,
            'email' => 'test@example.org',
            'address' => 'address',
            'phone_number' => 'phoneNumber',
            'is_marketing' => true,
            'avatar' => 'avatar',
            'created_at' => '2021-01-01 00:00:00',
            'updated_at' => '2021-01-01 00:00:00',
            'last_login_at' => '2021-01-01 00:00:00',
        ]);

        $this->assertSame('uuid', $response->getUuid());
        $this->assertSame('John', $response->getFirstName());
        $this->assertSame('Doe', $response->getLastName());
        $this->assertTrue($response->isAdmin());
        $this->assertSame('test@example.org', $response->getEmail());
        $this->assertSame('address', $response->getAddress());
        $this->assertSame('phoneNumber', $response->getPhoneNumber());
        $this->assertTrue($response->getIsMarketing());
        $this->assertSame('avatar', $response->getAvatar());
        $this->assertSame('2021-01-01 00:00:00', $response->getCreatedAt());
        $this->assertSame('2021-01-01 00:00:00', $response->getUpdatedAt());
        $this->assertSame('2021-01-01 00:00:00', $response->getLastLoginAt());
    }
}
