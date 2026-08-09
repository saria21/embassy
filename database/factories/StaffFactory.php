<?php

namespace Database\Factories;

use App\Models\staff;
use App\Models\department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fullName = fake()->name();

        return [
            "full_name" => $fullName,
            "job_title" => fake()->jobTitle(),
            "role" => fake()->randomElement(["Admin", "Interviewer", "Security", "Consular Officer"]),
            "department_id" => department::factory(),
        ];
    }
}
