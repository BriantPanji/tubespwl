<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostAttachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PostAttachment::factory(16)->create();
        $posts = Post::all();
        
        foreach ($posts as $post) {
            $amount = fake()->numberBetween(1, 3);
            for ($i = 0; $i < $amount; $i++) {
                PostAttachment::factory()->create([
                    'post_id' => $post->id,
                ]);
            }
        }
        
    }
}
