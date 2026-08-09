<?php

namespace Database\Factories;

use App\Models\citizen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<citizen>
 */
class CitizenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates a realistic passport string sequence (e.g., AB1234567)
            "passport_number" => fake()->unique()->regexify('[A-Z]{2}[0-9]{7}'),
            
            "full_name" => fake()->name(),
            "current_address" => fake()->address(),
        ];
    }
}
