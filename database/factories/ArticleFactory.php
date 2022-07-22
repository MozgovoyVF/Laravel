<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::first(),
            'code' => fake()->numberBetween(1, 1244124123),
            'title' => fake()->sentence(5, true),
            'description' => fake()->text(20),
            'content' => fake()->text(200),
            'published' => fake()->boolean(),
        ];
    }
}
