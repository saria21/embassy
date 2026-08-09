<?php

namespace Database\Factories;

use App\Models\auths;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<auths>
 */
class AuthFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Automatically creates a staff relation row to back this account
            "staff_id" => \App\Models\staff::factory(),
            
            // Generates official embassy-style username strings (e.g. j.doe@embassy.gov)
            "username" => fake()->unique()->userName() . "@embassy.gov",
            "password" => bcrypt('password123'), // Secure default testing password
        ];
    }
}