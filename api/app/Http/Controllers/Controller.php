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

    /**
     * @param class-string<CommandInterface> $commandClass
     */
    protected function dispatch(?FormRequest $request = null, string $commandClass = self::COMMAND_CLASS): ?JsonResponse
    {
        $command = $request !== null ?
            $commandClass::fromValidatedRequest($request)
            : new $commandClass();

        return response()->json([
            'data' => $this->commandBus->dispatch($command)?->toArray(),
        ]);
    }

    /**
     * @param class-string<QueryInterface> $queryClass
     */
    protected function ask(string $queryClass = self::QUERY_CLASS, bool $wrapInData = true): JsonResponse
    {
        $query = new $queryClass();

        $response = $this->queryBus->ask($query);

        if ($wrapInData) {
            return response()->json([
                'data' => $response->toArray(),
            ]);
        }

        return response()->json($response->toArray());
    }
}
