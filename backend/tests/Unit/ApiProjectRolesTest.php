<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\ProjectRole;
use App\Models\User;
use Tests\TestCase;

class ApiProjectRolesTest extends TestCase
{
    private string $uri = '/api/projects/';

    public function testGetProjectRoles(): void
    {
        $project = Project::factory()->create();
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            $projectRole = ProjectRole::factory()->create([
                'project_id' => $project->id
            ]);
        }
        $response = $this->get($this->uri . $project->id . '/roles');
        $roles = Project::whereId($project->id)->first()->roles->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($roles, $content);
    }

    public function testCreateProjectRole(): void
    {
        $project = Project::factory()->create();
        $response = $this->post($this->uri . $project->id . '/roles', [
            'name' => 'Test Project Role',
            'project_id' => $project->id,
            'is_can_create_posts' => fake()->boolean,
            'is_can_edit_posts' => fake()->boolean,
            'is_can_remove_posts' => fake()->boolean,
            'is_can_create_chats' => fake()->boolean,
            'is_can_invite_members' => fake()->boolean,
            'is_can_accept_members' => fake()->boolean,
            'is_can_remove_members' => fake()->boolean,
            'is_can_change_project_name' => fake()->boolean,
            'is_can_change_project_preview' => fake()->boolean,
            'is_can_change_project_description' => fake()->boolean,
            'is_can_change_project_preview_picture' => fake()->boolean,
            'is_can_change_project_detail_picture' => fake()->boolean
        ]);
        $content = $response->content();
        $role = Project::whereId($project->id)->first()->roles[0];
        $this->assertInstanceOf(ProjectRole::class, $role);
        $this->assertJsonStringEqualsJsonString($role->toJson(), $content);
    }

    public function testGetProjectRoleById(): void
    {
        $project = Project::factory()->create();
        $role = ProjectRole::factory()->create([
            'project_id' => $project->id
        ]);
        $response = $this->get($this->uri . $project->id . '/roles/' . $role->id);
        $content = $response->content();
        $roles = Project::whereId($project->id)->first()->roles;
        $this->assertJsonStringEqualsJsonString($roles[0]->toJson(), $content);
    }

    public function testUpdateProjectRole(): void
    {
        $project = Project::factory()->create();
        $role = ProjectRole::factory()->create([
            'name' => 'Project Role',
            'project_id' => $project->id,
            'is_can_edit_posts' => false,
            'is_can_remove_members' => false
        ]);

        $response = $this->put($this->uri . $project->id . '/roles/' . $role->id, [
            'name' => 'Project Test Role',
            'is_can_edit_posts' => true,
        ]);
        $response->assertStatus(200);

        $role = ProjectRole::whereId($role->id)->first();
        $this->assertEquals('Project Test Role', $role->name);
        $this->assertTrue($role->is_can_edit_posts);
        $this->assertFalse($role->is_can_remove_members);
    }

    public function testDeleteProjectRole(): void
    {
        $project = Project::factory()->create();
        $role = ProjectRole::factory()->create([
            'project_id' => $project->id
        ]);
        $response = $this->delete($this->uri . $project->id . '/roles/' . $role->id);
        $response->assertStatus(200);

        $project = Project::whereId($project->id)->first()->roles()->first();
        $this->assertNull($project);
    }
}
