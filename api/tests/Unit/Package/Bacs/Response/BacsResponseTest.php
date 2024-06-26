<?php

namespace Tests\Unit\Package\Bacs\Response;

use Bagene\Bacs\Response\BacsResponse;
use Tests\UnitTestCase;

final class BacsResponseTest extends UnitTestCase
{
    public function testGettersReturnCorrectValue(): void
    {
        $response = BacsResponse::fromArray([
            'vol' => 'test',
            'hdr1' => 'test',
            'hdr2' => 'test',
            'uhl' => 'test',
            'standard' => ['test'],
            'eof1' => 'test',
            'eof2' => 'test',
            'utl' => 'test',
        ]);

        $this->assertSame('test', $response->getVol());
        $this->assertSame('test', $response->getHdr1());
        $this->assertSame('test', $response->getHdr2());
        $this->assertSame('test', $response->getUhl());
        $this->assertSame(['test'], $response->getStandard());
        $this->assertSame('test', $response->getEof1());
        $this->assertSame('test', $response->getEof2());
        $this->assertSame('test', $response->getUtl());
    }
}
