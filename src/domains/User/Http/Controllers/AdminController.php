<?php

declare(strict_types=1);

namespace Domains\User\Http\Controllers;

use App\Commands\Admin\CreateAdminCommand;
use App\Http\Controllers\Controller;
use Domains\User\Http\Requests\CreateAdminRequest;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function create(CreateAdminRequest $request): JsonResponse
    {
        return $this->dispatch($request, CreateAdminCommand::class);
    }
}
