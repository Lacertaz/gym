<?php

namespace Database\Factories;

use App\MemberType;
use App\Models\GymPackage;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogMembership>
 */
class LogMembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'membership_id'    => Membership::factory(),
            'gym_package_id'   => GymPackage::factory(),
            'gym_package_name' => $this->faker->word,
            'price'            => $this->faker->randomNumber(9, true),
            'duration'         => $this->faker->numberBetween(1,3),
            'member_type'      => $this->faker->randomElement(MemberType::cases()),
            'start_date'       => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date'         => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
