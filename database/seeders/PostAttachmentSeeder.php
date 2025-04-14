<?php

namespace Database\Seeders;

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
        PostAttachment::factory(10)->create();
    }
}
