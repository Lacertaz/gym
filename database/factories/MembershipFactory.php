<?php

namespace Database\Factories;

use App\GenderType;
use App\MemberType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'gender'       => $this->faker->randomElement(GenderType::cases()),
            'member_type'  => $this->faker->randomElement(MemberType::cases()),
            'join_date'    => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expired_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'no_whatsapp'  => $this->faker->phoneNumber(),
            'status'       => $this->faker->boolean(),
        ];
    }
}
