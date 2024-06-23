<?php

declare(strict_types=1);

namespace App\Commands\Admin\Logout;

use Domains\User\Contracts\SessionRepositoryInterface;

final class LogoutCommandHandler
{
    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository
    ) {
    }

    public function __invoke(LogoutCommand $command): void
    {
        $jwtToken = $this->sessionRepository->getToken();

        if ($jwtToken) {
            $this->sessionRepository->delete($jwtToken);
        }
    }
}
