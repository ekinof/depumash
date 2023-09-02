<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Services\Game\GameBuilder;

class GameController extends Controller
{
    public function getGame(
        GameBuilder $gameBuilder,
    ): Game {
        $game = $gameBuilder->build();

        $game->save();

        return $game->load('firstRepresentative', 'secondRepresentative');
    }
}
