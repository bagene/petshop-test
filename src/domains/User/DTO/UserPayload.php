<?php

declare(strict_types=1);

namespace Domains\User\DTO;

use App\Shared\AbstractDTO;
use App\Shared\Traits\StaticConstructor;

final class UserPayload extends AbstractDTO
{
    use StaticConstructor;

    private function __construct(
        private readonly string $uuid,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly bool $isAdmin,
        private readonly string $email,
        private readonly string $password,
        private readonly string $address,
        private readonly string $phoneNumber,
        private readonly bool $isMarketing,
        private readonly ?string $avatar,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
}
