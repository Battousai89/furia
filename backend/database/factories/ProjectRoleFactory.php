<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectRole>
 */
class ProjectRoleFactory extends Factory
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
            'project_id' => fake()->randomElement(Project::query()->pluck('id')->toArray()),
            'create_posts' => fake()->boolean(),
            'edit_posts' => fake()->boolean(),
            'remove_posts' => fake()->boolean(),
            'create_chats' => fake()->boolean(),
            'invite_members' => fake()->boolean(),
            'accept_members' => fake()->boolean(),
            'remove_members' => fake()->boolean(),
            'change_project_name' => fake()->boolean(),
            'change_project_preview' => fake()->boolean(),
            'change_project_description' => fake()->boolean(),
            'change_project_preview_picture' => fake()->boolean(),
            'change_project_detail_picture' => fake()->boolean()
        ];
    }
}
