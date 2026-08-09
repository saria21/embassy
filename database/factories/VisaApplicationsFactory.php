<?php

namespace Database\Factories;

use App\Models\visa_applications;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<visa_applications>
 */
class VisaApplicationsFactory extends Factory
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
            
            // This cleanly spins up the required parent applicant record on the fly
            "applicant_id" => \App\Models\visa_applicants::factory(),
        ];
    }
}
