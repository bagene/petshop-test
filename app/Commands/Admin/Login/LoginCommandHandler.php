<?php

declare(strict_types=1);

namespace App\Commands\Admin\Login;

use App\Shared\Response\AuthResponse;
use Carbon\Carbon;
use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Contracts\UserRepositoryInterface;
use Domains\User\DTO\JwtTokenPayload;
use Domains\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;

final class LoginCommandHandler
{
    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly JwtManagerInterface $jwtManager,
    ) {
    }

    public function __invoke(LoginCommand $command): AuthResponse
    {
        /** @var User|null $user */
        $user = $this->userRepository->findBy('email', $command->getEmail());

        if (!$user && !Hash::check($command->getPassword(), optional($user)->password)) {
            throw new \Exception('Invalid credentials');
        }

        $tokenTtl = strtotime(JwtManagerInterface::TTL);
        $tokenNbf = strtotime(JwtManagerInterface::NBF);
        /** @var User $user */
        $token = $this->jwtManager->generate($user, $tokenTtl, $tokenNbf);
        Carbon::createFromTimestamp($tokenTtl);
        $this->sessionRepository->create(
            JwtTokenPayload::fromArray([
                'userId' => $user->id,
                'uniqueId' => $token,
                'expiresAt' => Carbon::createFromTimestamp($tokenTtl),
                'lastUsedAt' => Carbon::now(),
                'refreshedAt' => Carbon::now(),
            ]),
        );

        return AuthResponse::fromArray([
            'token' => $token,
            'expiresIn' => $tokenTtl,
        ]);
    }
}
