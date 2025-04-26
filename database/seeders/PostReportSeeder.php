<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory()->count(3)->create();
        $users = User::all();

        foreach ($users as $user) {
            $user->reportedPosts()->attach($posts->random(2));
        }
    }
}
