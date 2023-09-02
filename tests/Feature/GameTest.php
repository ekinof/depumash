<?php

declare(strict_types=1);

use Database\Seeders\GameSeeder;
use Database\Seeders\RepresentativeSeeder;

describe('GameController::postGame', function () {
    test('we can create a new game', function () {
        $this->seed(RepresentativeSeeder::class);

        $response = $this->post('/api/game');

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'id',
                'status',
                'first_representative' => [
                    'id',
                    'first_name',
                    'last_name',
                    'birthday',
                    'gender',
                    'job_title',
                ],
                'second_representative' => [
                    'id',
                    'first_name',
                    'last_name',
                    'birthday',
                    'gender',
                    'job_title',
                ],
            ]);
    });
});

describe('GameController::putGame', function () {
    test('we can play a game', function () {
        $this->seed(RepresentativeSeeder::class);
        $this->seed(GameSeeder::class);

        $newGameResponse = $this->post('/api/game');

        $response = $this->put('/api/game/'.$newGameResponse['id'], [
            'winner' => $newGameResponse['first_representative']['id'],
        ]);

        $response->assertOk();
    });

    it('should throw NotFound when id is not an UUID', function () {
        $this->seed(RepresentativeSeeder::class);
        $this->seed(GameSeeder::class);

        $response = $this->put('/api/game/'.'test', []);

        $response->assertNotFound();
    });

    it('should throw NotFound when id is not a gameId', function () {
        $this->seed(RepresentativeSeeder::class);
        $this->seed(GameSeeder::class);

        $response = $this->put('/api/game/'.'b88b1abf-34d4-1b40-9ee4-8576c09e09b7', []);

        $response->assertNotFound();
    });

    it('should throw an error when game has already been played', function () {
        $this->seed(RepresentativeSeeder::class);
        $this->seed(GameSeeder::class);

        $response = $this->put('/api/game/'.'138140b2-1dd2-11b2-878f-98362f428e8b', [
            'winner' => '138140d3-1dd2-11b2-aab7-df1836c463e7',
        ]);

        $response
            ->assertBadRequest()
            ->assertJsonFragment(['message' => 'Game already played or removed']);
    });

    it('should throw a validation exception when winner is not sent', function () {
        $this->seed(RepresentativeSeeder::class);
        $this->seed(GameSeeder::class);

        $newGameResponse = $this->post('/api/game');

        $response = $this->put('/api/game/'.$newGameResponse['id'], []);

        $response->assertJsonValidationErrors('winner');
    });

    test('should throw a validation exception when winner is not an UUID', function () {
        $this->seed(RepresentativeSeeder::class);
        $this->seed(GameSeeder::class);

        $newGameResponse = $this->post('/api/game');

        $response = $this->put('/api/game/'.$newGameResponse['id'], [
            'winner' => 'test',
        ]);

        $response->assertJsonValidationErrors('winner');
    });

    it('should throw an error when winner is not part of the game', function () {
        $this->seed(RepresentativeSeeder::class);
        $this->seed(GameSeeder::class);

        $response = $this->put('/api/game/'.'7db822e1-ce8e-1c89-8bca-2aff022c3bdd', [
            'winner' => '6053921a-29fb-1f18-ac0e-ef1e017ccb7b',
        ]);

        $response
            ->assertBadRequest()
            ->assertJsonFragment(['message' => 'Winner must be one of the representatives']);
    });
});
