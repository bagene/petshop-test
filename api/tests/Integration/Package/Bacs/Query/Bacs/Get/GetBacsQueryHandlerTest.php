<?php

declare(strict_types=1);

namespace Tests\Integration\Package\Bacs\Query\Bacs\Get;

use Bagene\Bacs\Query\Bacs\Get\GetBacsQuery;
use Bagene\Bacs\Query\Bacs\Get\GetBacsQueryHandler;
use Bagene\Bacs\Response\BacsResponse;
use Tests\FeatureIntegrationTestCase;

final class GetBacsQueryHandlerTest extends FeatureIntegrationTestCase
{
    private GetBacsQueryHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $handler = $this->app->make(GetBacsQueryHandler::class);
        $this->handler = $handler;
    }

    public function testInvoke(): void
    {
        $response = $this->handler->__invoke(GetBacsQuery::fromArray([]));

        $this->assertInstanceOf(BacsResponse::class, $response);
        $this->assertArrayHasKey('vol', $response->toArray());
        $this->assertArrayHasKey('hdr1', $response->toArray());
        $this->assertArrayHasKey('hdr2', $response->toArray());
        $this->assertArrayHasKey('uhl', $response->toArray());
        $this->assertArrayHasKey('standard', $response->toArray());
        $this->assertArrayHasKey('eof1', $response->toArray());
        $this->assertArrayHasKey('eof2', $response->toArray());
        $this->assertArrayHasKey('utl', $response->toArray());

    }
}
