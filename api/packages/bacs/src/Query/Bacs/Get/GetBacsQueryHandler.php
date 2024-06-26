<?php

declare(strict_types=1);

namespace Bagene\Bacs\Query\Bacs\Get;

use Bagene\Bacs\Contracts\BacsServiceInterface;
use Bagene\Bacs\Response\BacsResponse;

final class GetBacsQueryHandler
{
    public function __construct(private BacsServiceInterface $bacsService)
    {
    }

    public function __invoke(GetBacsQuery $query): BacsResponse
    {
        return BacsResponse::fromArray($this->bacsService->getBacs());
    }
}
