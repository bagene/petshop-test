<?php

namespace Tests;

use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\DTO\JwtTokenPayload;
use Domains\User\Models\JwtToken;
use Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;

abstract class FeatureIntegrationTestCase extends BaseTestCase
{
    use RefreshDatabase;

    public const POST_METHOD = 'POST';
    public const GET_METHOD = 'GET';

    protected function actAsAdminUser(): self
    {
        $jwtManager = $this->app->make(JwtManagerInterface::class);
        $sessionRepository = $this->app->make(SessionRepositoryInterface::class);
        $user = User::factory()->create(['is_admin' => true]);

        $token = $jwtManager->generate($user, strtotime(JwtManagerInterface::TTL), strtotime(JwtManagerInterface::NBF));

        $sessionRepository->create(
            JwtTokenPayload::fromArray([
                'userId' => $user->id,
                'uniqueId' => $token,
                'expiresAt' => now()->addMinutes(15),
                'lastUsedAt' => now(),
                'refreshedAt' => now(),
            ])
        );

        return $this->withHeader('Authorization', "Bearer $token");
    }
}
