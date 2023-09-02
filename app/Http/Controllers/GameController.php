<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Resources\Game\GameUpdateRequest;
use App\Models\Game;
use App\Services\Game\GameBuilder;
use App\Services\Game\GameResolver;

class GameController extends Controller
{
    public function postGame(
        GameBuilder $gameBuilder,
    ): Game {
        $game = $gameBuilder->build();

        $game->save();

        return $game->load('firstRepresentative', 'secondRepresentative');
    }

    public function putGame(
        Game $game,
        GameUpdateRequest $request,
        GameResolver $gameResolver,
    ) {
        $params = $request->validated();

        $gameResolver->resolve($game, $params['winner']);

        return response()->json([
            'message' => 'Game played successfully',
        ]);
    }
}
