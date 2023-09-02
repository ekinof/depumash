<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\GameStatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('game')->insert([
            'game_created' => [
                'id' => '7db822e1-ce8e-1c89-8bca-2aff022c3bdd',
                'first_representative_id' => '138140bf-1dd2-11b2-b569-84c37c225355',
                'second_representative_id' => '138140e4-1dd2-11b2-92a7-33d4db955d9b',
                'status' => GameStatusEnum::CREATED,
                'winner_representative_id' => null,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
                'deleted_at' => null,
            ],
            'game_played' => [
                'id' => '138140b2-1dd2-11b2-878f-98362f428e8b',
                'first_representative_id' => '138140bf-1dd2-11b2-b569-84c37c225355',
                'second_representative_id' => '138140e4-1dd2-11b2-92a7-33d4db955d9b',
                'winner_representative_id' => '138140bf-1dd2-11b2-b569-84c37c225355',
                'status' => GameStatusEnum::PLAYED,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
                'deleted_at' => null,
            ],
            'game_expired' => [
                'id' => '138140e9-1dd2-11b2-8910-d373270e64de',
                'first_representative_id' => '138140bf-1dd2-11b2-b569-84c37c225355',
                'second_representative_id' => '138140e4-1dd2-11b2-92a7-33d4db955d9b',
                'winner_representative_id' => '138140bf-1dd2-11b2-b569-84c37c225355',
                'status' => GameStatusEnum::EXPIRED,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
                'deleted_at' => '2021-01-01 00:00:00',
            ],
        ]);
    }
}
