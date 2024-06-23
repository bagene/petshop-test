<?php

declare(strict_types=1);

namespace App\Commands\Admin\Login;

use App\Shared\AbstractCommand;
use App\Shared\Traits\StaticConstructor;

final class LoginCommand extends AbstractCommand
{
    use StaticConstructor;
    private function __construct(
        private readonly string $email,
        private readonly string $password,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
