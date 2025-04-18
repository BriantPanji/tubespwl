<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostVotes>
 */
class PostVotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_upvoted'=>fake()->boolean(),
            'post_id'=>Post::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id
        ];
    }
}
