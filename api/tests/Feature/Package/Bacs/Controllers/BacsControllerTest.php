<?php

declare(strict_types=1);

namespace Tests\Feature\Package\Bacs\Controllers;

use Tests\FeatureIntegrationTestCase;

final class BacsControllerTest extends FeatureIntegrationTestCase
{
    const ROUTE = '/api/v1/bacs';
    const METHOD = 'GET';

    public function testBacs(): void
    {
        $response = $this->json(self::METHOD, self::ROUTE);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'vol',
                'hdr1',
                'hdr2',
                'uhl',
                'standard',
                'eof1',
                'eof2',
                'utl',
            ]
        ]);
    }
}
