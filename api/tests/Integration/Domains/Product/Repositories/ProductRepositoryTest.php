<?php

declare(strict_types=1);

namespace Tests\Integration\Domains\Product\Repositories;

use Domains\Product\Contracts\ProductRepositoryInterface;
use Domains\Product\Models\Category;
use Domains\Product\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\FeatureIntegrationTestCase;

final class ProductRepositoryTest extends FeatureIntegrationTestCase
{
    private ProductRepositoryInterface $repository;
    private string $uuid;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var ProductRepositoryInterface $repository */
        $repository = $this->app->make(ProductRepositoryInterface::class);
        $this->repository = $repository;

        $this->uuid = $this->repository->findNextUuid();
        /** @var Category $category */
        $category = Category::factory()->create();

        Product::factory()->create([
            'uuid' => $this->uuid,
            'category_id' => $category->id,
        ]);
    }

    public function testFindByUuid(): void
    {
        $product = $this->repository->findBy('uuid', $this->uuid);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($this->uuid, $product->uuid);
    }

    public function testSearch(): void
    {
        $result = $this->repository->search();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertGreaterThan(0, $result->total());
    }
}
