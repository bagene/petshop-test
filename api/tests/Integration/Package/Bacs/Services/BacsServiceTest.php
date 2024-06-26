<?php

declare(strict_types=1);

namespace Tests\Integration\Package\Bacs\Services;

use Bagene\Bacs\Contracts\BacsServiceInterface;
use Tests\FeatureIntegrationTestCase;

final class BacsServiceTest extends FeatureIntegrationTestCase
{
    private BacsServiceInterface $service;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var BacsServiceInterface $service */
        $service = $this->app->make(BacsServiceInterface::class);
        $this->service = $service;
    }

    public function testGetBacs(): void
    {
        $bacs = $this->service->getBacs();

        $this->assertIsArray($bacs);
        $this->assertArrayHasKey('vol', $bacs);
        $this->assertArrayHasKey('hdr1', $bacs);
        $this->assertArrayHasKey('hdr2', $bacs);
        $this->assertArrayHasKey('uhl', $bacs);
        $this->assertArrayHasKey('standard', $bacs);
        $this->assertArrayHasKey('eof1', $bacs);
        $this->assertArrayHasKey('eof2', $bacs);
        $this->assertArrayHasKey('utl', $bacs); }
}
