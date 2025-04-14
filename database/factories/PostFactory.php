<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
            'title' => fake()->sentence(4),
            'content'=> fake()->paragraph(3),
            'location'=>fake()->address(),
            'gmap_url'=>fake()->text(),
            'place_name'=> fake()->text(),
            'user_id'=> User::inRandomOrder()->first()->id
        ];
    }
}
