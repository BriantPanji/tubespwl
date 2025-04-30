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
        $posts = Post::all();
        $users = User::all();

        foreach ($users as $user) {
            $votedPostIds = []; // untuk menyimpan post_id yang sudah dipilih
            $random = rand(3, 10);
        
            for ($i = 0; $i < $random; $i++) {
                $post = $posts->random();
        
                // Ulangi sampai dapat post yang belum dipilih user ini
                while (in_array($post->id, $votedPostIds)) {
                    $post = $posts->random();
                }
        
                $user->votedPost()->attach($post->id, [
                    'is_upvoted' => rand(0, 1)
                ]);
        
                $votedPostIds[] = $post->id;
            }
        }
    }
}
