<?php

declare(strict_types=1);

namespace App\Commands\Admin\Logout;

use App\Shared\AbstractCommand;
use App\Shared\Traits\StaticConstructor;

final class LogoutCommand extends AbstractCommand
{
    use StaticConstructor;

    public function __construct()
    {
    }
}
