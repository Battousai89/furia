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
        $project = Project::factory()->create();
        return [
            'name' => fake()->name(),
            'project_id' => $project->id,
            'is_can_create_posts' => fake()->boolean(),
            'is_can_edit_posts' => fake()->boolean(),
            'is_can_remove_posts' => fake()->boolean(),
            'is_can_create_chats' => fake()->boolean(),
            'is_can_invite_members' => fake()->boolean(),
            'is_can_accept_members' => fake()->boolean(),
            'is_can_remove_members' => fake()->boolean(),
            'is_can_change_project_name' => fake()->boolean(),
            'is_can_change_project_preview' => fake()->boolean(),
            'is_can_change_project_description' => fake()->boolean(),
            'is_can_change_project_preview_picture' => fake()->boolean(),
            'is_can_change_project_detail_picture' => fake()->boolean()
        ];
    }
}
