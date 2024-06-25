<?php

declare(strict_types=1);

namespace App\Queries\Product\GetAll;

use App\Shared\AbstractQuery;
use App\Shared\Traits\StaticConstructor;

final class GetAllProductQuery extends AbstractQuery
{
    use StaticConstructor;

    public function __construct(
        private readonly ?int $page = null,
        private readonly ?int $limit = null,
        private readonly ?string $sortBy = null,
        private readonly ?bool $desc = null,
        private readonly ?string $category = null,
        private readonly ?float $price = null,
        private readonly ?string $brand = null,
        private readonly ?string $title = null,
    ) {
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    public function isDesc(): ?bool
    {
        return $this->desc;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
