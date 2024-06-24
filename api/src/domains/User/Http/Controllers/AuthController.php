<?php

declare(strict_types=1);

namespace Domains\User\Http\Controllers;

use App\Commands\Admin\Login\LoginCommand;
use App\Commands\Admin\Logout\LogoutCommand;
use App\Http\Controllers\Controller;
use App\Queries\User\Get\GetUserQuery;
use Domains\User\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): ?JsonResponse
    {
        try {
            return $this->dispatch($request, LoginCommand::class);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 401);
        }
    }

    public function logout(): void
    {
        $this->dispatch(commandClass: LogoutCommand::class);
    }

    public function me(): JsonResponse
    {
        return $this->ask(GetUserQuery::class);
    }
}
