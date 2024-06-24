<?php

namespace Integration\App\Commands\Admin\Create;

use App\Commands\Admin\Create\CreateAdminCommand;
use App\Commands\Admin\Create\CreateAdminCommandHandler;
use App\Shared\Response\UserResponse;
use Domains\User\Contracts\UserRepositoryInterface;
use Tests\FeatureIntegrationTestCase;

class CreateAdminCommandHandlerTest extends FeatureIntegrationTestCase
{
    private CreateAdminCommandHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var UserRepositoryInterface $repository */
        $repository = $this->app->make(UserRepositoryInterface::class);

        $this->handler = new CreateAdminCommandHandler($repository);
    }

    public function testInvokeReturnSuccessResponse(): void
    {
        $command = CreateAdminCommand::fromArray([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.org',
            'password' => 'password123',
            'avatar' => null,
            'address' => 'test address',
            'phone_number' => '1234567890',
            'is_marketing' => true,
        ]);

        $response = $this->handler->__invoke($command);

        $this->assertInstanceOf(UserResponse::class, $response);
        $this->assertSame('John', $response->getFirstName());
        $this->assertSame('Doe', $response->getLastName());
        $this->assertSame('test@example.org', $response->getEmail());
        $this->assertSame('test address', $response->getAddress());
        $this->assertSame('1234567890', $response->getPhoneNumber());
        $this->assertTrue($response->getIsMarketing());
        $this->assertTrue($response->isAdmin());
        $this->assertNotNull($response->getUuid());
        $this->assertNotNull($response->getCreatedAt());
        $this->assertNotNull($response->getUpdatedAt());

        $this->assertDatabaseHas('users', [
            'uuid' => $response->getUuid(),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.org',
            'address' => 'test address',
            'phone_number' => '1234567890',
            'is_marketing' => true,
            'is_admin' => true,
        ]);
    }
}
