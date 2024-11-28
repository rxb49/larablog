<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
    public function definition(): array
    {
        return [
			'user_id' => $this->faker->numberBetween(1,2),
			'draft' => $this->faker->numberBetween(0, 1),
			'title' => Str::random(10),
			'content' => Str::random(10),

		];
    }
}
