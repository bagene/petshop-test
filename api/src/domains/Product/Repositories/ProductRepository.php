<?php

declare(strict_types=1);

namespace Domains\Product\Repositories;

use App\Shared\AbstractRepository;
use Domains\Product\Contracts\ProductRepositoryInterface;
use Domains\Product\Models\Product;
use Illuminate\Database\DatabaseManager;

final class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    public function __construct(
        DatabaseManager $databaseManager,
        Product $model,
    ) {
        parent::__construct($databaseManager, $model);
    }
}
