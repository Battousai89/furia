<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMember>
 */
class ProjectMemberFactory extends Factory
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
            'project_role_id' => fake()->randomElement(ProjectRole::query()->pluck('id')->toArray())
        ];
    }
}
