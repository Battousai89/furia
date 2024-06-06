<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class ApiProjectsTest extends TestCase
{
    private string $uri = '/api/';

    //PROJECTS
    public function testGetProjects(): void
    {
        $response = $this->get($this->uri . 'projects');
        $users = Project::all()->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($users, $content);
    }

    public function testGetProjectById(): void
    {
        $project = Project::factory()->create();
        $response = $this->get($this->uri . 'projects/' . $project->id);
        $content = $response->content();
        $project->toJson();
        $this->assertJsonStringEqualsJsonString($project, $content);
    }

    public function testCreateProject(): void
    {
        $user = User::factory()->create();
        $response = $this->post($this->uri . 'projects', [
            'name' => 'Test Project',
            'user_id' => $user->id,
            'preview_text' => 'test_preview_text',
            'description' => 'test_description',
            'preview_picture' => null,
            'detail_picture' => null,
        ]);
        $content = $response->content();
        $project = Project::whereName('Test Project')->first();
        $this->assertInstanceOf(Project::class, $project);
        $this->assertJsonStringEqualsJsonString($project->toJson(), $content);
    }

    public function testUpdateProject(): void
    {
        $project = Project::factory()->create([
            'name' => 'Test Project',
            'user_id' => null
        ]);
        $response = $this->put($this->uri . 'projects/' . $project->id, [
            'name' => 'Project Test',
            'user_id' => null,
            'preview_text' => 'test_preview_text',
            'description' => 'test_description',
            'preview_picture' => null,
            'detail_picture' => null,
        ]);
        $response->assertStatus(200);

        $project = Project::whereId($project->id)->first();
        $this->assertEquals('Project Test', $project->name);
    }

    public function testDeleteProject(): void
    {
        $project = Project::factory()->create();
        $response = $this->delete($this->uri . 'projects/' . $project->id);
        $response->assertStatus(200);

        $project = Project::whereId($project->id)->first();
        $this->assertNull($project);
    }
}
