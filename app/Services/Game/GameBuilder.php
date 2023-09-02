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
        $game->first_representative_id = $representatives[0]->id;
        $game->second_representative_id = $representatives[1]->id;
        $game->status = GameStatusEnum::CREATED;

        return $game;
    }
}
