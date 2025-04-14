<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentVotes>
 */
class CommentVotesFactory extends Factory
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
            'comment_id'=>Comment::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id
        ];
    }
}
