<?php

namespace Database\Factories;

use App\Models\User;
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
        $user = User::factory()->create();
        return [
            'name' => fake()->name(),
            'user_id' => $user->id,
            'preview_text' => fake()->text(),
            'description' => fake()->text(),
            'preview_picture' => fake()->filePath(),
            'detail_picture' => fake()->filePath(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
