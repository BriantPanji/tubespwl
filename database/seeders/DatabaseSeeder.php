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
            ['display_name' => 'Sutanto', 'username' => 'sutanto', 'email' => 'sutanto@example.com', 'avatar' => 'blankprofile.png'],
            ['display_name' => 'Feri',    'username' => 'feri',    'email' => 'feri@example.com', 'avatar' => 'blankprofile.png'],
            ['display_name' => 'Delrico', 'username' => 'delrico', 'email' => 'delrico@example.com', 'avatar' => 'blankprofile.png'],
            ['display_name' => 'Panji Ganteng',   'username' => 'panjikun',   'email' => 'panji@example.com', 'avatar' => 'avatar_panjay.jpg'],
            ['display_name' => 'Andreas', 'username' => 'andreas', 'email' => 'andreas@example.com', 'avatar' => 'blankprofile.png'],
        ];

        foreach($users as $user){
            User::create([
                'display_name' => $user['display_name'],
                'username'     => $user['username'],
                'email'        => $user['email'],
                'email_verified_at' => now(),
                'is_admin'     => true,
                'is_banned'    => false,
                'avatar'       => $user['avatar'],
                'password'     => Hash::make('pass123'),
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
