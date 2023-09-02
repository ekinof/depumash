<?php

declare(strict_types=1);

namespace App\Services\Game;

use App\Enum\GameStatusEnum;
use App\Models\Game;
use App\Models\Representative;

class GameBuilder
{
    public function build(): Game
    {
        $game = new Game();

        $representatives = Representative::inRandomOrder()->take(2)->get();
        $game->firstRepresentative()->associate($representatives[0]);
        $game->secondRepresentative()->associate($representatives[1]);
        $game->status = GameStatusEnum::CREATED;

        return $game;
    }
}
