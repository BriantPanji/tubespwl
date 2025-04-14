<?php

namespace Database\Seeders;

use App\Models\CommentVotes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommentVotes::factory(20)->create();
    }
}
