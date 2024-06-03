<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => 3,
            'preview_text' => fake()->text(),
            'description' => fake()->text(),
            'preview_picture' => fake()->filePath(),
            'detail_picture' => fake()->filePath(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
