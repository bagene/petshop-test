<?php

declare(strict_types=1);

namespace Infrastructure\Services\Jwt;

use App\Shared\Exceptions\AuthException;
use Domains\User\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;
use Infrastructure\Services\Jwt\DTO\TokenData;

final readonly class JwtManager implements JwtManagerInterface
{
    public function __construct(
        private string $domain,
        private string $key,
    ) {
    }

    public function generate(
        User $user,
        int $ttl,
        int $nbf,
    ): string {
        $payload = [
            'iss' => $this->domain,
            'exp' => $ttl,
            'nbf' => $nbf,
            'user_uuid' => $user->uuid,
        ];

        return JWT::encode(
            $payload,
            $this->key,
            self::ALGORITHM,
        );
    }

    public function parse(string $token): TokenData
    {
        try {
            $key = new Key($this->key, self::ALGORITHM);

            $data = (array) JWT::decode($token, $key);

            return TokenData::fromArray($data);
        } catch (\Throwable $e) {
            throw new AuthException();
        }
    }
}
