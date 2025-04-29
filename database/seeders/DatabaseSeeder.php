<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'display_name' => 'Test User',
            'username'=> 'testuser',
            'email' => 'test@example.com',
            'is_admin'=>true
        ]);

        $this->call([
            PostSeeder::class,
            CommentSeeder::class,
            BadgeSeeder::class,
            CommentReportSeeder::class,
            CommentVotesSeeder::class,
            PostReportSeeder::class,
            PostVotesSeeder::class,
            TagSeeder::class,
            BookmarkSeeder::class,
            PostAttachmentSeeder::class,
        ]);
    }
}
