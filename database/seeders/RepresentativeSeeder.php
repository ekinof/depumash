<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\GenderEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('representative')->insert([
            'representative_1' => [
                'id' => '138140bf-1dd2-11b2-b569-84c37c225355',
                'first_name' => 'Jonluk',
                'last_name' => 'Meluch',
                'gender' => GenderEnum::MALE,
                'job_title' => 'Manifestant',
                'birthday' => '1990-01-01',
                'external_id' => 'PA001',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ],
            'representative_2' => [
                'id' => '138140e4-1dd2-11b2-92a7-33d4db955d9b',
                'first_name' => 'Manu',
                'last_name' => 'Micron',
                'gender' => GenderEnum::MALE,
                'job_title' => 'Banquier',
                'birthday' => '1990-01-01',
                'external_id' => 'PA002',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ],
        ]);
    }
}
