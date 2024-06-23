<?php

declare(strict_types=1);

namespace App\Queries\User\Get;

use App\Shared\Response\UserResponse;
use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Models\User;

final class GetUserQueryHandler
{
    public function __construct(private readonly SessionRepositoryInterface $sessionRepository)
    {
    }

    public function __invoke(GetUserQuery $query): UserResponse
    {
        /** @var User $user */
        $user = $this->sessionRepository->getUser();

        return UserResponse::fromModel($user);
    }
}
