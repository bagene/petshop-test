<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Product\Response;

use Domains\Product\Response\ProductResponse;
use Tests\UnitTestCase;

final class ProductResponseTest extends UnitTestCase
{
    public function testGettersReturnCorrectValues(): void
    {
        $productResponse = ProductResponse::fromArray([
            'uuid' => 'uuid',
            'category_uuid' => 'category_uuid',
            'title' => 'title',
            'description' => 'description',
            'price' => 1.0,
            'metadata' => ['image' => 'image', 'brand' => 'brand'],
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
            'category' => ['id' => 1, 'uuid' => 'uuid', 'title' => 'title', 'slug' => 'slug', 'created_at' => 'created_at', 'updated_at' => 'updated_at'],
            'brand' => ['brand' => 'brand'],
        ]);

        $this->assertSame('uuid', $productResponse->getUuid());
        $this->assertSame('category_uuid', $productResponse->getCategoryUuid());
        $this->assertSame('title', $productResponse->getTitle());
        $this->assertSame(1.0, $productResponse->getPrice());
        $this->assertSame('description', $productResponse->getDescription());
        $this->assertSame(['image' => 'image', 'brand' => 'brand'], $productResponse->getMetadata());
        $this->assertSame('created_at', $productResponse->getCreatedAt());
        $this->assertSame('updated_at', $productResponse->getUpdatedAt());
        $this->assertSame('deleted_at', $productResponse->getDeletedAt());
        $this->assertSame(['id' => 1, 'uuid' => 'uuid', 'title' => 'title', 'slug' => 'slug', 'created_at' => 'created_at', 'updated_at' => 'updated_at'], $productResponse->getCategory());
        $this->assertSame(['brand' => 'brand'], $productResponse->getBrand());
    }
}
