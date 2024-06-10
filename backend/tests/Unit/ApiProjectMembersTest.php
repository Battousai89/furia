<?php

namespace Tests\Unit;

use App\Models\ProjectMember;
use App\Models\ProjectRole;
use App\Models\User;
use Tests\TestCase;

class ApiProjectMembersTest extends TestCase
{
    private string $uri = '/api/projects/members/';

    public function testGetProjectMembers(): void
    {
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            ProjectMember::factory()->create();
        }
        $response = $this->get($this->uri);
        $members = ProjectMember::query()->get()->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($members, $content);
    }

    public function testCreateProjectMember(): void
    {
        $user = User::factory()->create();
        $response = $this->post($this->uri, [
            'user_id' => $user->id,
            'project_role_id' => null,
        ]);
        $content = $response->content();
        $member = User::whereId($user->id)->first()->projectGroups[0];
        $this->assertInstanceOf(ProjectMember::class, $member);
        $this->assertJsonStringEqualsJsonString($member->toJson(), $content);
    }

    public function testGetProjectMemberById(): void
    {
        $user = User::factory()->create();
        $member = ProjectMember::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->get($this->uri . $member->id);
        $content = $response->content();
        $groups = User::whereId($user->id)->first()->projectGroups;
        $this->assertJsonStringEqualsJsonString($groups[0]->toJson(), $content);
    }

    public function testUpdateProjectMember(): void
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $projectRole = ProjectRole::factory()->create();

        $member = ProjectMember::factory()->create([
            'user_id' => $user->id,
            'project_role_id' => null,
        ]);
        $response = $this->put($this->uri . $member->id, [
            'user_id' => $user2->id,
            'project_role_id' => $projectRole->id,
        ]);
        $response->assertStatus(200);

        $member = ProjectMember::whereId($member->id)->first();
        $this->assertEquals($user2->id, $member->user->id);
        $this->assertEquals($projectRole->id, $member->role->id);
    }

    public function testDeleteProjectMember(): void
    {
        $member = ProjectMember::factory()->create();

        $response = $this->delete($this->uri . $member->id);
        $response->assertStatus(200);

        $member = ProjectMember::whereId($member->id)->first();
        $this->assertNull($member);
    }
}
