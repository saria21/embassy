<?php

namespace Database\Factories;

use App\Models\visits_logs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<visits_logs>
 */
class visits_logsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Safe foreign key linking back to an auto-generated employee record
            "staff_id" => \App\Models\staff::factory(),
            
            // Matches your migration columns perfectly
            "visitor_id" => fake()->numberBetween(1000, 9999), 
            "check_in_time" => fake()->dateTimeBetween('-1 month', 'now'),
            "check_out_time" => fake()->optional(0.7)->dateTimeBetween('-1 month', 'now'), 
        ];
    }
}
