<?php

namespace Database\Factories;

use App\Models\related_buildings;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<related_buildings>
 */
class related_buildingsFactory extends Factory
{
    protected $model = related_buildings::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // This ensures that when we call count(3), it loops through these 3 exact places in order
        return [
            'name' => $this->faker->unique()->randomElement([
                'Embassy of Japan in Damascus',
                'Japanese Literature Department at Damascus University',
                'Japan Center for Academic Cooperation in Aleppo'
            ]),
        ];
    }
}
