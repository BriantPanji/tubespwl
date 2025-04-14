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
            'displayName' => 'Test User',
            'username'=> 'testuser',
            'email' => 'test@example.com',
            'isAdmin'=>false
        ]);

        $this->call([
            PostSeeder::class,
            CommentSeeder::class,
            BadgeSeeder::class,
            CommentReportSeeder::class,
            CommentVotesSeeder::class,
            PostAttachmentSeeder::class,
            PostReportSeeder::class,
            PostVotesSeeder::class,
            PostVotesSeeder::class,
            TagSeeder::class
        ]);
    }
}
