<?php

declare(strict_types=1);

namespace Infrastructure\Services\CommandBus\Contracts;

interface CommandHandlerInterface
{
    public function __invoke(CommandInterface $command): CommandResponseInterface;
}
