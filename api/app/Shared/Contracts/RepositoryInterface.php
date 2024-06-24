<?php

declare(strict_types=1);

namespace App\Shared\Contracts;

use App\Shared\AbstractDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    const DEFAULT_LIMIT = 10;

    public function transaction(callable $callback): mixed;

    public function findNextUuid(): string;

    public function create(AbstractDTO $dto): Model;

    public function update(Model $model, AbstractDTO $dto): Model;

    public function find(string|int $id): ?Model;

    public function findBy(string $column, mixed $value): ?Model;

    public function delete(Model $model): bool;

    /**
     * @param array<string, mixed> $filters
     * @return LengthAwarePaginator<Model>
     */
    public function search(array $filters = []): LengthAwarePaginator;

    /**
     * @param array<string, mixed> $filters
     * @return Collection<int, Model>
     */
    public function get(array $filters = []): Collection;
}
