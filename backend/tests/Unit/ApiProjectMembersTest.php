<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectRole;
use App\Models\User;
use Tests\TestCase;

class ApiProjectMembersTest extends TestCase
{
    private string $uri = '/api/projects/';

    public function testGetProjectMembers(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            $projectMember = ProjectMember::factory()->create([
                'project_id' => $project->id,
                'user_id' => $user->id,
                'project_role_id' => null
            ]);
        }
        $response = $this->get($this->uri . $project->id . '/members');
        $members = Project::whereId($project->id)->first()->members->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($members, $content);
    }

    public function testCreateProjectMember(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();
        $response = $this->post($this->uri . $project->id . '/members', [
            'project_id' => $project->id,
            'user_id' => $user->id,
            'project_role_id' => null,
        ]);
        $content = $response->content();
        $member = Project::whereId($project->id)->first()->members[0];
        $this->assertInstanceOf(ProjectMember::class, $member);
        $this->assertJsonStringEqualsJsonString($member->toJson(), $content);
    }

    public function testGetProjectMemberById(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();
        $member = ProjectMember::factory()->create([
            'project_id' => $project->id,
            'user_id' => $user->id,
        ]);
        $response = $this->get($this->uri . $project->id . '/members/' . $member->id);
        $content = $response->content();
        $members = Project::whereId($project->id)->first()->members;
        $this->assertJsonStringEqualsJsonString($members[0]->toJson(), $content);
    }

    public function testUpdateProjectMember(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $projectRole = ProjectRole::factory()->create();

        $member = ProjectMember::factory()->create([
            'user_id' => $user->id,
            'project_id' => $project->id,
            'project_role_id' => null,
        ]);
        $response = $this->put($this->uri . $project->id . '/members/' . $member->id, [
            'user_id' => $user2->id,
            'project_id' => $project->id,
            'project_role_id' => $projectRole->id,
        ]);
        $response->assertStatus(200);

        $member = ProjectMember::whereId($member->id)->first();
        $this->assertEquals($user2->id, $member->user->id);
        $this->assertEquals($projectRole->id, $member->role->id);
    }

    public function testDeleteProjectMember(): void
    {
        $project = Project::factory()->create();
        $member = ProjectMember::factory()->create();

        $response = $this->delete($this->uri . $project->id . '/members/' . $member->id);
        $response->assertStatus(200);

        $member = ProjectMember::whereId($member->id)->first();
        $this->assertNull($member);
    }
}
