<?php

declare(strict_types=1);

namespace Bagene\Bacs\Response;

use App\Shared\Traits\StaticConstructor;
use App\Shared\Traits\ToArray;
use Infrastructure\Services\QueryBus\Contracts\QueryResponseInterface;

final class BacsResponse implements QueryResponseInterface
{
    use StaticConstructor, ToArray;

    /**
     * @param string[] $standard
     */
    private function __construct(
        private readonly string $vol,
        private readonly string $hdr1,
        private readonly string $hdr2,
        private readonly string $uhl,
        private readonly array $standard,
        private readonly string $eof1,
        private readonly string $eof2,
        private readonly string $utl,
    ) {
    }

    public function getVol(): string
    {
        return $this->vol;
    }

    public function getHdr1(): string
    {
        return $this->hdr1;
    }

    public function getHdr2(): string
    {
        return $this->hdr2;
    }

    public function getUhl(): string
    {
        return $this->uhl;
    }

    /**
     * @return string[]
     */
    public function getStandard(): array
    {
        return $this->standard;
    }

    public function getEof1(): string
    {
        return $this->eof1;
    }

    public function getEof2(): string
    {
        return $this->eof2;
    }

    public function getUtl(): string
    {
        return $this->utl;
    }
}
