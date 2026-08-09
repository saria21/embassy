<?php

namespace Database\Factories;

use App\Models\visa_applicants;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<visa_applicants>
 */
class visa_applicantsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "passport_number" => fake()->unique()->regexify('[A-Z]{2}[0-9]{7}'),
            "full_name" => fake()->name(),
            "nationality" => fake()->randomElement(["Japanese", "Syrian"]),
        ];
    }
}
