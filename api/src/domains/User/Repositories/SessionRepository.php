<?php

declare(strict_types=1);

namespace Domains\User\Repositories;

use App\Shared\AbstractRepository;
use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Models\JwtToken;
use Domains\User\Models\User;
use Illuminate\Database\DatabaseManager;

final class SessionRepository extends AbstractRepository implements SessionRepositoryInterface
{
    protected ?User $user = null;
    protected ?JwtToken $jwtToken = null;

    public function __construct(DatabaseManager $database, JwtToken $model)
    {
        parent::__construct($database, $model);

        $this->user = null;
        $this->jwtToken = null;
    }

    public function setSession(JwtToken $jwtToken): void
    {
        $this->user = $jwtToken->user;

        $jwtToken->last_used_at = now();
        $jwtToken->save();

        $this->jwtToken = $jwtToken;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getToken(): ?JwtToken
    {
        return $this->jwtToken;
    }
}
