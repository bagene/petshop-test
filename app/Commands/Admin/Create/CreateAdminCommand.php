<?php

declare(strict_types=1);

namespace App\Commands\Admin\Create;

use App\Shared\AbstractCommand;
use App\Shared\Traits\StaticConstructor;

final class CreateAdminCommand extends AbstractCommand
{
    use StaticConstructor;

    private function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $password,
        private readonly ?string $avatar,
        private readonly string $address,
        private readonly string $phoneNumber,
        private readonly bool $isMarketing,
    ) {
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getIsMarketing(): bool
    {
        return $this->isMarketing;
    }
}
