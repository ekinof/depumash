<?php

declare(strict_types=1);

namespace App\Interfaces\Commands;

interface TransactionalCommand
{
    public function handleTransaction(): void;
}
