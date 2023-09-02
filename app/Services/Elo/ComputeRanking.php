<?php

declare(strict_types=1);

namespace App\Services\Elo;

use App\Models\Representative;

class ComputeRanking
{
    private int $kFactor;

    public function __construct()
    {
        $this->kFactor = config('vars.elo.k_factor');
    }

    public function compute(Representative $winner, Representative $looser): void
    {
        $winner->elo->score = $this->computeElo($winner->elo->score, $looser->elo->score, 1);
        $looser->elo->score = $this->computeElo($looser->elo->score, $winner->elo->score, 0);

        $winner->elo->save();
        $looser->elo->save();
    }

    private function computeElo($elo1, $elo2, $score): float
    {
        return $elo1 + ($this->kFactor * ($score - $this->getExpectedScore($elo1, $elo2)));
    }

    private function getExpectedScore($elo1, $elo2): float
    {
        return 1 / (1 + (10 ** (($elo2 - $elo1) / 400)));
    }
}
