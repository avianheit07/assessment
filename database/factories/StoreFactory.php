<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_id' => Brand::factory(),
            'number'   => $this->faker->e164PhoneNumber(),
            'address'  => $this->faker->address(),
            'city'     => $this->faker->city(),
            'state'    => $this->faker->state(),
            'zip_code' => $this->faker->postcode(),
        ];
    }
}
