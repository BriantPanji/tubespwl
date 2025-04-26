<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::factory()->count(3)->create();
        $users = User::all();

        foreach ($users as $user) {
            $user->votedComments()->attach($comments->random(2), [
                'is_upvoted' => rand(0, 1)
            ]);
        }
    }
}
