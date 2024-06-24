<?php

declare(strict_types=1);

namespace Domains\User\Contracts;

use App\Shared\Contracts\RepositoryInterface;
use Domains\User\Models\JwtToken;
use Domains\User\Models\User;

interface SessionRepositoryInterface extends RepositoryInterface
{
    public function setSession(JwtToken $jwtToken): void;

    public function getUser(): ?User;

    public function getToken(): ?JwtToken;
}
