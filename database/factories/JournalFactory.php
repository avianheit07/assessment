<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class JournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id'   => Store::factory(),
            'date'       => $this->faker->date(),
            'revenue'    => $this->faker->randomFloat(2, 1000, 10000),
            'food_cost'  => $this->faker->randomFloat(2, 100, 1000),
            'labor_cost' => $this->faker->randomFloat(2, 100, 1000),
            'profit'     => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
