<?php

namespace Database\Factories;

use App\Models\related_buildings;
use Illuminate\Database\Eloquent\Factories\Factory;


// @extends Factory<related_buildings>
 
class related_buildingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();

        return [
            "name" => ucfirst($name) . " Building",
        ];
    }
}
