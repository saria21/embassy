<?php

namespace Database\Factories;

use App\Models\consular_requests;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<consular_requests>
 */
class ConsularRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Ties this consular task cleanly to a public citizen profile row
            "citizen_id" => \App\Models\citizen::factory(),
            
            "request_type" => fake()->randomElement(["Passport Renewal", "Birth Registration", "Emergency Assistance"]),
            "status" => fake()->randomElement(["Received", "In Progress", "Completed"]),
        ];
    }
}
