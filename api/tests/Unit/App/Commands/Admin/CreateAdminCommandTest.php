<?php

declare(strict_types=1);

namespace Tests\Unit\App\Commands\Admin;

use App\Commands\Admin\Create\CreateAdminCommand;
use Tests\UnitTestCase;

final class CreateAdminCommandTest extends UnitTestCase
{
    public function testGetttersReturnCorrectValues(): void
    {
        $command = CreateAdminCommand::fromArray([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.org',
            'password' => 'password',
            'avatar' => 'avatar',
            'address' => 'address',
            'phone_number' => 'phoneNumber',
            'is_marketing' => true,
        ]);

        $this->assertSame('John', $command->getFirstName());
        $this->assertSame('Doe', $command->getLastName());
        $this->assertSame('test@example.org', $command->getEmail());
        $this->assertSame('password', $command->getPassword());
        $this->assertSame('avatar', $command->getAvatar());
        $this->assertSame('address', $command->getAddress());
        $this->assertSame('phoneNumber', $command->getPhoneNumber());
        $this->assertTrue($command->getIsMarketing());
    }
}
