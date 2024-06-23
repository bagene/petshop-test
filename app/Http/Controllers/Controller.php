<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Infrastructure\Services\CommandBus\Contracts\CommandBusInterface;
use Infrastructure\Services\CommandBus\Contracts\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Infrastructure\Services\QueryBus\Contracts\QueryBusInterface;
use Infrastructure\Services\QueryBus\Contracts\QueryInterface;

abstract class Controller
{
    protected const COMMAND_CLASS = CommandInterface::class;
    protected const QUERY_CLASS = QueryInterface::class;
    public function __construct(
        protected readonly CommandBusInterface $commandBus,
        protected readonly QueryBusInterface $queryBus
    ) {
    }

    protected function dispatch(FormRequest $request, string $commandClass = self::COMMAND_CLASS): JsonResponse
    {
        $command = call_user_func(
            [$commandClass, 'fromValidatedRequest'],
            $request
        );

        return response()->json([
            'data' => $this->commandBus->dispatch($command)->toArray(),
        ]);
    }

    protected function ask(): JsonResponse
    {
        /** @var class-string<QueryInterface> $queryClass */
        $queryClass = static::QUERY_CLASS;
        $query = new $queryClass();

        return response()->json([
            'data' => $this->queryBus->ask($query)->toArray(),
        ]);
    }
}
