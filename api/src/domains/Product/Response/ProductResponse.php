<?php

declare(strict_types=1);

namespace Domains\Product\Response;

use App\Shared\AbstractDTO;
use App\Shared\Traits\StaticConstructor;
use Infrastructure\Services\QueryBus\Contracts\QueryResponseInterface;

final class ProductResponse extends AbstractDTO implements QueryResponseInterface
{
    use StaticConstructor;

    /**
     *
     * @param array{image?: string, brand: string}|null $metadata
     * @param array{
     *     id: int,
     *     uuid: string,
     *     title: string,
     *     slug: string,
     *     created_at: string,
     *     updated_at: string,
     * } $category
     * @param array<string, mixed>|null $brand
     */
    private function __construct(
        private readonly string $uuid,
        private readonly string $categoryUuid,
        private readonly string $title,
        private readonly float $price,
        private readonly string $description,
        private readonly ?array $metadata,
        private readonly string $createdAt,
        private readonly string $updatedAt,
        private readonly ?string $deletedAt,
        private readonly array $category,
        private readonly ?array $brand,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getCategoryUuid(): string
    {
        return $this->categoryUuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array{image?: string, brand: string}|null
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    /**
     * @return array{
     *      id: int,
     *      uuid: string,
     *      title: string,
     *      slug: string,
     *      created_at: string,
     *      updated_at: string,
     *  }
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getBrand(): ?array
    {
        return $this->brand;
    }
}
