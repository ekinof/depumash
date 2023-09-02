<?php

declare(strict_types=1);

namespace App\Traits\Commands;

use Illuminate\Support\Facades\DB;

trait UseTransaction
{
    public function handleTransaction(): void
    {
        DB::transaction(function () {
            $this->runQuery();
        });
    }

    /**
     * This method should only be executed inside the handleTransaction method
     */
    abstract private function runQuery();
}
