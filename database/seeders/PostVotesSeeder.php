<?php

namespace Database\Seeders;

use App\Models\PostVotes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostVotes::factory(10)->create();
    }
}
