<?php

declare(strict_types=1);

namespace Tests\Integration\Infrastructure\Services\Jwt;

use Domains\User\Models\User;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;
use Infrastructure\Services\Jwt\DTO\TokenData;
use Tests\FeatureIntegrationTestCase;

final class JwtManagerTest extends FeatureIntegrationTestCase
{
    const TTL = '+15 minutes';
    const NBF = '+0 minutes';
    private JwtManagerInterface $jwtManager;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var JwtManagerInterface $jwtManager */
        $jwtManager = $this->app->make(JwtManagerInterface::class);
        $this->jwtManager = $jwtManager;
    }

    public function testGenerateJwt(): void
    {
        $user = User::factory()->create();

        $jwt = $this->jwtManager->generate($user, strtotime(self::TTL), strtotime(self::NBF));

        $this->assertIsString($jwt);
    }

    public function testParseJwt(): void
    {
        $user = User::factory()->create();

        $jwt = $this->jwtManager->generate($user, strtotime(self::TTL), strtotime(self::NBF));
        $payload = $this->jwtManager->parse($jwt);

        $this->assertInstanceOf(TokenData::class, $payload);
        $this->assertIsString($payload->getIss());
        $this->assertIsInt($payload->getExp());
        $this->assertIsInt($payload->getNbf());
        $this->assertSame($user->uuid, $payload->getUserUuid());
    }
}
