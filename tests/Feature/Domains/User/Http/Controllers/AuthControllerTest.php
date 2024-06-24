<?php

declare(strict_types=1);

namespace Tests\Feature\Domains\User\Http\Controllers;

use Domains\User\Models\User;
use Tests\FeatureIntegrationTestCase;

final class AuthControllerTest extends FeatureIntegrationTestCase
{
    const LOGIN_URL = '/api/v1/{type}/login';
    const LOGOUT_URL = '/api/v1/{type}/logout';
    const POST_METHOD =  'POST';
    const DELETE_METHOD = 'DELETE';

    public function testAdminLoginSuccess(): void
    {
        User::factory()->create([
            'email' => 'admin@example.org',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        $response = $this->json(
            self::POST_METHOD,
            str_replace('{type}', 'admin', self::LOGIN_URL),
            [
                'email' => 'admin@example.org',
                'password' => 'password123',
            ],
        );


    }
}
