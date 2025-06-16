<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            ['display_name' => 'Sutanto', 'username' => 'sutanto', 'email' => 'sutanto@example.com'],
            ['display_name' => 'Feri',    'username' => 'feri',    'email' => 'feri@example.com'],
            ['display_name' => 'Delrico', 'username' => 'delrico', 'email' => 'delrico@example.com'],
            ['display_name' => 'Panji',   'username' => 'panji',   'email' => 'panji@example.com'],
            ['display_name' => 'Andreas', 'username' => 'andreas', 'email' => 'andreas@example.com'],
        ];

        foreach($users as $user){
            User::create([
                'display_name' => $user['display_name'],
                'username'     => $user['username'],
                'email'        => $user['email'],
                'email_verified_at' => now(),
                'is_admin'     => true,
                'is_banned'    => false,
                'avatar'       => 'blankprofile.png',
                'password'     => Hash::make('password123'),
            ]);
        }

        $this->call([
            TagSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            BadgeSeeder::class,
            CommentReportSeeder::class,
            CommentVotesSeeder::class,
            PostVotesSeeder::class,
            BookmarkSeeder::class,
        ]);
    }
}
