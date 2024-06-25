<?php

declare(strict_types=1);

namespace App\Queries\Product\GetAll;

use App\Shared\Response\PaginatedResponse;
use Domains\Product\Contracts\ProductRepositoryInterface;

final class GetAllProductQueryHandler
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function handle(GetAllProductQuery $query): PaginatedResponse
    {
        $products = $this->productRepository->search(with: ['category']);

        return PaginatedResponse::fromArray($products->toArray());
    }
}
