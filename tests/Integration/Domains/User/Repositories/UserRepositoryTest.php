<?php

declare(strict_types=1);

namespace Integration\Domains\User\Repositories;

use App\Shared\Exceptions\DatabaseTransactionException;
use Domains\User\Contracts\UserRepositoryInterface;
use Domains\User\DTO\UserPayload;
use Domains\User\Models\User;
use Tests\FeatureIntegrationTestCase;

final class UserRepositoryTest extends FeatureIntegrationTestCase
{
    private UserRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var UserRepositoryInterface $repository */
        $repository = $this->app->make(UserRepositoryInterface::class);
        $this->repository = $repository;
    }

    public function testCreateUser(): void
    {
        $user = $this->repository->create(
            UserPayload::fromArray([
                'uuid' => $this->repository->findNextUuid(),
                'firstName' => 'John',
                'lastName' => 'Doe',
                'isAdmin' => true,
                'email' => 'test@example.org',
                'password' => 'password',
                'address' => 'address',
                'phoneNumber' => 'phoneNumber',
                'isMarketing' => true,
                'avatar' => 'avatar',
            ])
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('John', $user->first_name);
        $this->assertSame('Doe', $user->last_name);
        $this->assertTrue($user->is_admin);
        $this->assertSame('test@example.org', $user->email);
        $this->assertSame('address', $user->address);
        $this->assertSame('phoneNumber', $user->phone_number);
        $this->assertTrue($user->is_marketing);
        $this->assertSame('avatar', $user->avatar);
    }

    public function testCreateFailed(): void
    {
        User::factory()->create([
            'email' => 'test@example.org',
        ]);

        $this->expectException(DatabaseTransactionException::class);

        $this->repository->create(
            UserPayload::fromArray([
                'uuid' => $this->repository->findNextUuid(),
                'firstName' => 'John',
                'lastName' => 'Doe',
                'isAdmin' => true,
                'email' => 'test@example.org', // This email already exists
                'password' => 'password',
                'address' => 'address',
                'phoneNumber' => 'phoneNumber',
                'isMarketing' => true,
                'avatar' => 'avatar',
            ])
        );
    }

    public function testUpdateUser(): void
    {
        $user = User::factory()->create();

        $this->repository->update(
            $user,
            UserPayload::fromArray([
                'uuid' => $user->uuid,
                'firstName' => 'Jane',
                'lastName' => 'Doe',
                'isAdmin' => false,
                'email' => 'test@example.org',
                'password' => 'password',
                'address' => 'address',
                'phoneNumber' => 'phoneNumber',
                'isMarketing' => true,
                'avatar' => 'avatar',
            ])
        );

        $this->assertSame('Jane', $user->first_name);
        $this->assertSame('Doe', $user->last_name);
        $this->assertFalse($user->is_admin);
        $this->assertSame('test@example.org', $user->email);
        $this->assertSame('address', $user->address);
        $this->assertSame('phoneNumber', $user->phone_number);
        $this->assertTrue($user->is_marketing);
        $this->assertSame('avatar', $user->avatar);
    }

    public function testFind(): void
    {
        $user = User::factory()->create();

        $foundUser = $this->repository->find($user->id);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertSame($user->uuid, $foundUser->uuid);
        $this->assertSame($user->first_name, $foundUser->first_name);
        $this->assertSame($user->last_name, $foundUser->last_name);
        $this->assertSame($user->is_admin, $foundUser->is_admin);
        $this->assertSame($user->email, $foundUser->email);
        $this->assertSame($user->address, $foundUser->address);
        $this->assertSame($user->phone_number, $foundUser->phone_number);
        $this->assertSame($user->is_marketing, $foundUser->is_marketing);
        $this->assertSame($user->avatar, $foundUser->avatar);
    }

    public function testFindNextUuid(): void
    {
        $uuid = $this->repository->findNextUuid();

        $this->assertIsString($uuid);
    }

    public function testDelete(): void
    {
        $user = User::factory()->create();

        $this->repository->delete($user);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function testFindBy(): void
    {
        $user = User::factory()->create();

        $foundUser = $this->repository->findBy('email', $user->email);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertSame($user->uuid, $foundUser->uuid);
        $this->assertSame($user->first_name, $foundUser->first_name);
        $this->assertSame($user->last_name, $foundUser->last_name);
        $this->assertSame($user->is_admin, $foundUser->is_admin);
        $this->assertSame($user->email, $foundUser->email);
        $this->assertSame($user->address, $foundUser->address);
        $this->assertSame($user->phone_number, $foundUser->phone_number);
        $this->assertSame($user->is_marketing, $foundUser->is_marketing);
        $this->assertSame($user->avatar, $foundUser->avatar);
    }

    public function testSearch(): void
    {
        User::factory()->count(10)->create();

        $users = $this->repository->search();

        $this->assertCount(10, $users);
    }

    public function testGet(): void
    {
        User::factory()->count(10)->create();

        $users = $this->repository->get();

        $this->assertCount(10, $users);
    }
}
