<?php

declare(strict_types=1);

namespace Infrastructure\Services\CommandBus\Bus;

use Illuminate\Contracts\Bus\Dispatcher;
use Infrastructure\Services\CommandBus\Contracts\CommandBusInterface;
use Infrastructure\Services\CommandBus\Contracts\CommandInterface;
use Infrastructure\Services\CommandBus\Contracts\CommandResponseInterface;

final readonly class CommandBus implements CommandBusInterface
{
    public function __construct(private Dispatcher $bus)
    {
    }

    public function dispatch(CommandInterface $command): CommandResponseInterface
    {
        /** @var CommandResponseInterface $response */
        $response = $this->bus->dispatch($command);

        return $response;
    }

    /**
     * @inheritdoc
     */
    public function map(array $map): void
    {
        $this->bus->map($map);
    }
}
