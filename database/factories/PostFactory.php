<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $placeTypes = [
            fn () => 'Ayam Penyet ' . fake()->firstNameFemale(),
            fn () => 'Warung ' . fake()->lastName(),
            fn () => 'Taman ' . fake()->lastName(),
            fn () => 'SMAN ' . fake()->numberBetween(1, 5) . ' ' . fake()->city(),
            fn () => 'Masjid ' . fake()->name(),
            fn () => 'Cafe ' . fake()->colorName(),
            fn () => 'Universitas ' . fake()->city(),
            fn () => 'Apotek ' . fake()->company(),
        ];
        $place_name = fake()->randomElement($placeTypes)();
        return [
            'title' => fake()->sentence(4),
            'content'=> fake()->paragraph(3),
            'location'=>fake()->address(),
            'gmap_url'=> "https://maps.app.goo.gl/" . fake()->bothify('?#??#?#?#?##?#??'),
            'place_name'=> $place_name,
            'user_id'=> User::inRandomOrder()->first()->id
        ];
    }
}
