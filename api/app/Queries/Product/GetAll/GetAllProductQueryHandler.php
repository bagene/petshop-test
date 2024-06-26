<?php

declare(strict_types=1);

namespace App\Queries\Product\GetAll;

use App\Shared\Response\PaginatedResponse;
use Domains\File\Contracts\FileRepositoryInterface;
use Domains\File\Models\File;
use Domains\Product\Contracts\ProductRepositoryInterface;

final class GetAllProductQueryHandler
{
    private const DEFAULT_PER_PAGE = 20;
    private const DEFAULT_PAGE = 1;
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly FileRepositoryInterface $fileRepository,
    ) {
    }

    public function handle(GetAllProductQuery $query): PaginatedResponse
    {
        $products = $this->productRepository->search(
            pagination: [
                'page' => $query->getPage() ?? self::DEFAULT_PAGE,
                'perPage' => $query->getLimit() ?? self::DEFAULT_PER_PAGE,
            ],
            with: ['category']
        );

        $productArray = $products->toArray();
        return PaginatedResponse::fromArray([
            ...$products->toArray(),
            'data' => array_map(function ($product) {
                if ($imgUuid = data_get($product, 'metadata.image')) {
                    /** @var File $image */
                    $image = $this->fileRepository->findBy('uuid', $imgUuid);
                    $product['metadata']['image'] = $image->toArray();
                }

                return $product;
            }, $productArray['data']),
        ]);
    }
}
