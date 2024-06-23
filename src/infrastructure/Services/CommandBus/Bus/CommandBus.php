<?php

declare(strict_types=1);

namespace Infrastructure\Services\CommandBus\Bus;

use Illuminate\Contracts\Bus\Dispatcher;
use Infrastructure\Services\CommandBus\Contracts\CommandBusInterface;
use Infrastructure\Services\CommandBus\Contracts\CommandInterface;
use Infrastructure\Services\CommandBus\Contracts\CommandResponseInterface;
use Infrastructure\Services\Shared\Traits\BusMapper;

final readonly class CommandBus implements CommandBusInterface
{
    use BusMapper;

    public function __construct(private Dispatcher $bus)
    {
    }

    public function dispatch(CommandInterface $command): ?CommandResponseInterface
    {
        return $this->bus->dispatch($command);
    }
}
