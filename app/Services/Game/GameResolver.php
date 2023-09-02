<?php

declare(strict_types=1);

namespace App\Services\Game;

use App\Enum\GameStatusEnum;
use App\Models\Elo;
use App\Models\Game;
use App\Services\Elo\ComputeRanking;
use App\Services\Elo\EloBuilder;

class GameResolver
{
    public function __construct(
        private readonly ComputeRanking $computeRanking,
        private readonly EloBuilder $eloBuilder,
    ) {
    }

    public function resolve(Game $game, string $winnerId): void
    {
        $winner = null;
        $loser = null;
        switch ($winnerId) {
            case $game->first_representative_id:
                $winner = $game->firstRepresentative;
                $loser = $game->secondRepresentative;

                break;
            case $game->second_representative_id:
                $winner = $game->secondRepresentative;
                $loser = $game->firstRepresentative;

                break;
            default:
                abort(400, 'Winner must be one of the representatives');
        }

        if (! $winner->elo instanceof Elo) {
            $winner->elo()->save($this->eloBuilder->build($winner));
            $winner->refresh();
        }

        if (! $loser->elo instanceof Elo) {
            $loser->elo()->save($this->eloBuilder->build($loser));
            $loser->refresh();
        }

        $this->computeRanking->compute($winner, $loser);

        $game->winner()->associate($winner);
        $game->status = GameStatusEnum::PLAYED;
        $game->save();
    }
}
