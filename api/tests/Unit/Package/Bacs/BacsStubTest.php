<?php

declare(strict_types=1);

namespace Tests\Unit\Package\Bacs;

use Bagene\Bacs\BacsStub;
use Tests\UnitTestCase;

final class BacsStubTest extends UnitTestCase
{
    public function testStubReturnsArray(): void
    {
        $stub = BacsStub::stub();

        $this->assertIsArray($stub);
        $this->assertArrayHasKey('vol', $stub);
        $this->assertArrayHasKey('hdr1', $stub);
        $this->assertArrayHasKey('hdr2', $stub);
        $this->assertArrayHasKey('uhl', $stub);
        $this->assertArrayHasKey('standard', $stub);
        $this->assertArrayHasKey('eof1', $stub);
        $this->assertArrayHasKey('eof2', $stub);
        $this->assertArrayHasKey('utl', $stub);
    }
}
