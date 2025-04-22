<?php

namespace Database\Seeders;

use App\Models\Bookmarks;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::pluck('id');

        foreach ($users as $user) {
            if (fake()->boolean(50)) {
                $bookmarksCount = fake()->numberBetween(1, 5);
                $bookmarkedPosts = $posts->random($bookmarksCount)->unique();

                $user->bookmarks()->attach($bookmarkedPosts);
            }
        }
    }
}
