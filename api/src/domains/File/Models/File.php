<?php

declare(strict_types=1);

namespace Domains\File\Models;

use Database\Factories\FileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected static function newFactory(): FileFactory
    {
        return FileFactory::new();
    }
}
