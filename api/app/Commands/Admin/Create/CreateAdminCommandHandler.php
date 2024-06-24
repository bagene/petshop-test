<?php

declare(strict_types=1);

namespace App\Commands\Admin\Create;

use App\Shared\Response\UserResponse;
use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Contracts\UserRepositoryInterface;
use Domains\User\DTO\JwtTokenPayload;
use Domains\User\DTO\UserPayload;
use Domains\User\Models\User;
use Illuminate\Support\Carbon;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;

final readonly class CreateAdminCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function __invoke(CreateAdminCommand $command): UserResponse
    {
        /** @var User $user */
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
