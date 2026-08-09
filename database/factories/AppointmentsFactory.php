<?php
namespace Database\Factories;

use App\Models\appointments;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends Factory<appointments>
 */
class AppointmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        
            "applicant_id" => \App\Models\visa_applicants::factory(),
            "citizen_id" => \App\Models\citizen::factory(),
            "interviewer_staff_id" => \App\Models\staff::factory(),
            
            "appointment_date" => fake()->dateTimeBetween('now', '+2 months'),
            "purpose_of_visit" => fake()->randomElement(["Visa Interview", "Passport Renewal", "Document Attestation", "Notary Services"]),
        ];
    }
}
