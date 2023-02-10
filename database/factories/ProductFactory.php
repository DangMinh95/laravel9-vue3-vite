<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pname' => fake()->name(),
            'price' => fake()->numberBetween(10,100),
            'category_id' => fake()->numberBetween(1, 20),
            'manufactor' => fake()->company()
        ];
    }
}
