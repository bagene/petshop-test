<?php

declare(strict_types=1);

namespace Tests\Integration\Domains\User\Repositories;

use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Models\JwtToken;
use Domains\User\Models\User;
use Tests\FeatureIntegrationTestCase;

final class SessionRepositoryTest extends FeatureIntegrationTestCase
{
    private SessionRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var SessionRepositoryInterface $repository */
        $repository = $this->app->make(SessionRepositoryInterface::class);
        $this->repository = $repository;
    }

    public function testGetNullUserWhenNoSession(): void
    {
        $this->assertNull($this->repository->getUser());
    }

    public function testGetNullTokenWhenNoSession(): void
    {
        $this->assertNull($this->repository->getToken());
    }

    public function testSetSession(): void
    {
        $jwtToken = $this->createAdminSession();

        $this->repository->setSession($jwtToken);

        $this->assertNotNull($this->repository->getUser());
        $this->assertInstanceOf(User::class, $this->repository->getUser());
        $this->assertNotNull($this->repository->getToken());
        $this->assertInstanceOf(JwtToken::class, $this->repository->getToken());
    }
}
