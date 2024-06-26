<?php

declare(strict_types=1);

namespace App\Queries\Product\Get;

use App\Shared\Response\ErrorResponse;
use Domains\Product\Contracts\ProductRepositoryInterface;
use Domains\Product\Models\Product;
use Domains\Product\Response\ProductResponse;

final class GetProductQueryHandler
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
    ) {
    }

    public function __invoke(GetProductQuery $query): ProductResponse|ErrorResponse
    {
        $product = $this->productRepository->findBy(
            'uuid',
            $query->getUuid(),
            ['category']
        );

        if ($product === null) {
            return ErrorResponse::create('Product not found', 404);
        }

        /** @var Product $product */
        return ProductResponse::fromArray([
            ...$product->toArray(),
            'category_uuid' => $product->category?->uuid,
            'category' => $product->category?->toArray(),
        ]);
    }
}
