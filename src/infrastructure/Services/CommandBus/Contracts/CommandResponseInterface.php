<?php

declare(strict_types=1);

namespace Infrastructure\Services\CommandBus\Contracts;

interface CommandResponseInterface
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(): array;
}
