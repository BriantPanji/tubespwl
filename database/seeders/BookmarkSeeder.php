<?php

namespace Database\Seeders;

use App\Models\Bookmarks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bookmarks::factory()
            ->count(10)
            ->create();
    }
}
