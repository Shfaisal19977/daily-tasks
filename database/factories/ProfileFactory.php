<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bio' => fake()->optional()->paragraph(),
            'phone' => fake()->optional()->phoneNumber(),
            'address' => fake()->optional()->address(),
            'avatar' => fake()->optional()->imageUrl(200, 200, 'people'),
            'date_of_birth' => fake()->optional()->date('Y-m-d', '-18 years'),
            'location' => fake()->optional()->city() . ', ' . fake()->optional()->country(),
            'website' => fake()->optional()->url(),
        ];
    }
}
