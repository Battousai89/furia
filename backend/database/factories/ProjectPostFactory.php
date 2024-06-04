<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectPost>
 */
class ProjectPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => fake()->randomElement(Project::query()->pluck('id')->toArray()),
            'user_id' => fake()->randomElement(User::query()->pluck('id')->toArray()),
            'title' => fake()->sentence(),
            'preview_text' => fake()->text(),
            'description' => fake()->text(),
            'preview_picture' => fake()->filePath(),
            'detail_picture' => fake()->filePath(),
        ];
    }
}
