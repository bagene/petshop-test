<?php

declare(strict_types=1);

namespace Domains\User\DTO;

use App\Shared\AbstractDTO;
use App\Shared\Traits\StaticConstructor;

final class JwtTokenPayload extends AbstractDTO
{
    use StaticConstructor;
    const DEFAULT_TOKEN_TITLE = 'Bearer';

    /**
     * @param array<string,mixed>|null $restrictions
     * @param array<string,mixed>|null $permissions
     */
    private function __construct(
        private readonly int $userId,
        private readonly string $uniqueId,
        private readonly string $tokenTitle = self::DEFAULT_TOKEN_TITLE,
        private readonly ?array $restrictions = null,
        private readonly ?array $permissions = null,
        private readonly ?\DateTimeInterface $expiresAt = null,
        private readonly ?\DateTimeInterface $lastUsedAt = null,
        private readonly ?\DateTimeInterface $refreshedAt = null,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    public function getTokenTitle(): string
    {
        return $this->tokenTitle;
    }

    /**
     * @return array<string,mixed>|null
     */
    public function getRestrictions(): ?array
    {
        return $this->restrictions;
    }

    /**
     * @return array<string,mixed>|null
     */
    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function getLastUsedAt(): ?\DateTimeInterface
    {
        return $this->lastUsedAt;
    }

    public function getRefreshedAt(): ?\DateTimeInterface
    {
        return $this->refreshedAt;
    }
}
