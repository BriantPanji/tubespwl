<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Badge>
 */
class BadgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'badge_name'=>fake()->word(),
            'badge_desc'=>fake()->sentence(1),
            'badge_color'=>fake()->hexColor(),
            'badge_icon'=> '<i class="fa-solid fa-play langkahPertama lv3"></i>',
        ];
    }
}
