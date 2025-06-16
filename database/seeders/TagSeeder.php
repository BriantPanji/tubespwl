<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'hidden gem',      
            'kuliner',         
            'sejarah',         
            'alam',            
            'instagramable',   
            'budget friendly', 
            'romantis',        
            'mistis',          
            'budaya',          
            'hiburan',          
            'edukasi',         
            'petualangan',      
        ];

        foreach ($names as $name) {
            Tag::create(['name' => $name]);
        }
    }
}