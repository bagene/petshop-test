<?php

declare(strict_types=1);

namespace App\Commands\Admin;

use App\Shared\Response\UserResponse;
use Domains\User\Contracts\UserRepositoryInterface;
use Domains\User\DTO\UserPayload;

final readonly class CreateAdminCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function __invoke(CreateAdminCommand $command): UserResponse
    {
        $user = $this->userRepository->create(
            UserPayload::fromArray([
                ...$command->toArray(),
                'uuid' => $this->userRepository->findNextUuid(),
                'password' => bcrypt($command->getPassword()),
                'isAdmin' => true,
            ])
        );

        return UserResponse::fromModel($user);
    }
}
