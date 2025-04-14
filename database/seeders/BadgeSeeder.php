<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Badge::factory(5)->create();
        $badges = Badge::factory()->count(3)->create();
        $users = User::all();

        foreach ($users as $user) {
            $user->badges()->attach($badges->random(2));
        }
    }
}
