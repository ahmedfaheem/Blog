<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           "title" => fake()->sentence(3),
           "description" => fake()->text(300),
           "author_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
        ];
    }
}
