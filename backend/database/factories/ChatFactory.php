<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $project = Project::factory()->create();
        return [
            'title' => fake()->sentence(),
            'project_id' => fake()->randomElement([null, $project->id]),
            'description' => fake()->text(),
            'picture' => fake()->filePath()
        ];
    }
}
