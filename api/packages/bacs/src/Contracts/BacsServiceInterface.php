<?php

declare(strict_types=1);

namespace Bagene\Bacs\Contracts;

interface BacsServiceInterface
{
    /**
     * @return array{
     *     vol: string,
     *     hdr1: string,
     *     hdr2: string,
     *     uhl: string,
     *     standard: string[],
     *     eof1: string,
     *     eof2: string,
     *     utl: string,
     * }
     */
    public function getBacs(): array;
}
