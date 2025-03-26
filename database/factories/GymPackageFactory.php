<?php

namespace Database\Factories;

use App\MemberType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymPackage>
 */
class GymPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(100_000, 1_000_000),
            'duration' => $this->faker->numberBetween([
                1,
                3,
                6,
                9,
                12,
                24,
            ]),
            'member_type' => $this->faker->randomElement(MemberType::cases()),
        ];
    }
}
