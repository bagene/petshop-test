<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Infrastructure\Services\CommandBus\Contracts\CommandBusInterface;
use Infrastructure\Services\CommandBus\Contracts\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected const COMMAND_CLASS = CommandInterface::class;
    public function __construct(
        protected readonly CommandBusInterface $commandBus
    ) {
    }

    protected function dispatch(FormRequest $request): JsonResponse
    {
        /** @var class-string<CommandInterface> $commandClass */
        $commandClass = static::COMMAND_CLASS;
        $command = call_user_func(
            [$commandClass, 'fromValidatedRequest'],
            $request
        );

        return response()->json([
            'data' => $this->commandBus->dispatch($command)->toArray(),
        ]);
    }
}
