<?php

declare(strict_types=1);

namespace Domains\User\Http\Controllers;

use App\Commands\Admin\Create\CreateAdminCommand;
use App\Commands\Admin\Login\LoginCommand;
use App\Http\Controllers\Controller;
use Domains\User\Http\Requests\CreateAdminRequest;
use Domains\User\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function create(CreateAdminRequest $request): JsonResponse
    {
        return $this->dispatch($request, CreateAdminCommand::class);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->dispatch($request, LoginCommand::class);
    }
}
