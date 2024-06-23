<?php

declare(strict_types=1);

namespace Tests\Feature\Domains\User\Http\Controllers;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\FeatureIntegrationTestCase;

final class AdminControllerTest extends FeatureIntegrationTestCase
{
    const CREATE_ADMIN_URL = '/api/v1/admin/create';

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUnauthorized(): void
    {
        $response = $this->json(self::POST_METHOD, self::CREATE_ADMIN_URL);

        $response->assertStatus(401);
    }

    public function testAdminCreateReturnSuccess(): void
    {
        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.org',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'avatar' => null,
            'address' => 'test address',
            'phone_number' => '1234567890',
            'is_marketing' => true,
        ];

        $response = $this
            ->actAsAdminUser()
            ->json(self::POST_METHOD, self::CREATE_ADMIN_URL, $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'uuid',
                'first_name',
                'last_name',
                'email',
                'avatar',
                'address',
                'phone_number',
                'is_marketing',
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $payload['email'],
            'first_name' => $payload['first_name'],
            'last_name' => $payload['last_name'],
            'address' => $payload['address'],
            'phone_number' => $payload['phone_number'],
            'is_marketing' => $payload['is_marketing'],
        ]);
    }

    /**
     * @param array<string,string|int> $payload
     * @param array<string,string> $errors
     */
    #[DataProvider('providerInvalidPayload')]
    public function testAdminCreateReturnError(array $payload, array $errors): void
    {
        $response = $this
            ->actAsAdminUser()
            ->json(self::POST_METHOD, self::CREATE_ADMIN_URL, $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors($errors);
    }

    /**
     * @return array<string, array<int, array<string, int|string>>>
     */
    public static function providerInvalidPayload(): array
    {
        return [
            'empty' => [
                [],
                [
                    'first_name' => 'The first name field is required.',
                    'last_name' => 'The last name field is required.',
                    'email' => 'The email field is required.',
                    'password' => 'The password field is required.',
                    'address' => 'The address field is required.',
                    'phone_number' => 'The phone number field is required.',
                    'is_marketing' => 'The is marketing field is required.',
                ],
            ],
            'invalid_data' => [
                [
                    'first_name' => 1,
                    'last_name' => 1,
                    'email' => 'invalid-email',
                    'password' => 'short',
                    'address' => 1,
                    'phone_number' => 1,
                    'is_marketing' => 'invalid',
                ],
                [
                    'first_name' => 'The first name field must be a string.',
                    'last_name' => 'The last name field must be a string.',
                    'email' => 'The email field must be a valid email address.',
                    'password' => 'The password field must be at least 8 characters.',
                    'address' => 'The address field must be a string.',
                    'phone_number' => 'The phone number field must be a string.',
                    'is_marketing' => 'The is marketing field must be true or false.',
                ],
            ],
        ];
    }
}
