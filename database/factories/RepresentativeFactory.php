<?php

namespace Database\Factories;

use App\Enum\GenderEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Representative>
 */
class RepresentativeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            [
                'id' => '138140bf-1dd2-11b2-b569-84c37c225355',
                'first_name' => 'Jonluk',
                'last_name' => 'Meluch',
                'gender' => GenderEnum::MALE,
                'job_title' => 'Manifestant',
                'birthday' => '1990-01-01',
                'external_id' => 'PA001',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ]
        ];
    }
}
