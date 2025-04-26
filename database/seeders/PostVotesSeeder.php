<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory()->count(3)->create();
        $users = User::all();

        foreach ($users as $user) {
            $user->votedPost()->attach($posts->random(2), [
                'is_upvoted' => rand(0, 1)
            ]);
        }
    }
}
