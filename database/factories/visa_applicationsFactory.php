<?php

namespace Database\Factories;

use App\Models\visa_applications;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<visa_applications>
 */
class visa_applicationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "visa_type" => fake()->randomElement(["Tourist", "Business", "Student", "Work"]),
            "application_status" => fake()->randomElement(["Pending", "Approved", "Rejected"]),
            
            // This hooks directly into your lowercase visa_applicants factory
            "applicant_id" => \App\Models\visa_applicants::factory(),
        ];
    }
}
