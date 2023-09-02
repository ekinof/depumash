<?php

declare(strict_types=1);

namespace App\Services\Elo;

use App\Models\Elo;
use App\Models\Representative;

class EloBuilder
{
    public function build(Representative $representative): Elo
    {
        $elo = new Elo();
        $elo->score = config('vars.elo.default_score');
        $elo->representative()->associate($representative);

        return $elo;
    }
}
