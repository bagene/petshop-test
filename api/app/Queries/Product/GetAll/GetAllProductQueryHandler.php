<?php

declare(strict_types=1);

namespace App\Queries\Product\GetAll;

use App\Shared\Response\PaginatedResponse;
use Domains\File\Contracts\FileRepositoryInterface;
use Domains\Product\Contracts\ProductRepositoryInterface;

final class GetAllProductQueryHandler
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly FileRepositoryInterface $fileRepository,
    ) {
    }

    public function handle(GetAllProductQuery $query): PaginatedResponse
    {
        $products = $this->productRepository->search(
            pagination: [
                'page' => $query->getPage(),
                'perPage' => $query->getLimit(),
            ],
        );

        $productArray = $products->toArray();
        return PaginatedResponse::fromArray([
            ...$products->toArray(),
            'data' => array_map(function ($product) {

                if ($imgUuid = data_get($product, 'metadata.image')) {
                    $product['image'] = $this->fileRepository
                        ->findBy('uuid', $imgUuid)
                        ->toArray();
                }

                return $product;
            }, $productArray['data']),
        ]);
    }
}
