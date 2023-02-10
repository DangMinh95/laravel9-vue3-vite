<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->text(20),
            'likes' => fake()->numberBetween(10, 100),
            'user_id' => fake()->numberBetween(1,2),
            'commentable_id' => fake()->numberBetween(1, 50),
            'commentable_type' => config('common.modelsPath') . 'Product'
        ];
    }
}
