<?php

declare(strict_types=1);

namespace Domains\File\Repositories;

use App\Shared\AbstractRepository;
use Domains\File\Contracts\FileRepositoryInterface;
use Domains\File\Models\File;
use Illuminate\Database\DatabaseManager;

final class FileRepository extends AbstractRepository implements FileRepositoryInterface
{
    public function __construct(
        DatabaseManager $databaseManager,
        File $model,
    ) {
        parent::__construct($databaseManager, $model);
    }
}
