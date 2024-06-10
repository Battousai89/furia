<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\ProjectPost;
use App\Models\User;
use Tests\TestCase;

class ApiProjectPostsTest extends TestCase
{
    private string $uri = '/api/projects/posts/';

    public function testGetProjectPosts(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            ProjectPost::factory()->create([
                'project_id' => $project->id,
                'user_id' => $user->id,
                'title' => 'Test Title',
                'preview_text' => 'Test preview',
                'description' => 'Test Description',
                'preview_picture' => fake()->randomElement([null, fake()->filePath()]),
                'detail_picture' => fake()->randomElement([null, fake()->filePath()]),
            ]);
        }
        $response = $this->get($this->uri);
        $posts = ProjectPost::query()->get()->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($posts, $content);
    }

    public function testCreateProjectPost(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();
        $response = $this->post($this->uri, [
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Test Title',
            'preview_text' => 'Test preview',
            'description' => 'Test Description',
            'preview_picture' => fake()->randomElement([null, fake()->filePath()]),
            'detail_picture' => fake()->randomElement([null, fake()->filePath()]),
        ]);
        $content = $response->content();
        $post = Project::whereId($project->id)->first()->posts[0];
        $this->assertInstanceOf(ProjectPost::class, $post);
        $this->assertJsonStringEqualsJsonString($post->toJson(), $content);
    }

    public function testGetProjectPostById(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();
        $post = ProjectPost::factory()->create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Test Title',
            'preview_text' => 'Test preview',
            'description' => 'Test Description',
            'preview_picture' => fake()->randomElement([null, fake()->filePath()]),
            'detail_picture' => fake()->randomElement([null, fake()->filePath()]),
        ]);
        $response = $this->get($this->uri . $post->id);
        $content = $response->content();
        $posts = Project::whereId($project->id)->first()->posts;
        $this->assertJsonStringEqualsJsonString($posts[0]->toJson(), $content);
    }

    public function testUpdateProjectPost(): void
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();

        $post = ProjectPost::factory()->create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Test Title',
            'preview_text' => 'Test preview',
            'description' => 'Test Description',
            'preview_picture' => fake()->randomElement([null, fake()->filePath()]),
            'detail_picture' => fake()->randomElement([null, fake()->filePath()]),
        ]);
        $response = $this->put($this->uri . $post->id, [
            'project_id' => $project->id,
            'title' => 'Title Test',
            'preview_text' => 'Test preview',
            'description' => 'Test Description',
        ]);
        $response->assertStatus(200);
        $user->delete();

        $post = ProjectPost::whereId($post->id)->first();
        $this->assertNull($post->author);
        $this->assertEquals('Title Test', $post->title);
    }

    public function testDeleteProjectPost(): void
    {
        $post = ProjectPost::factory()->create();

        $response = $this->delete($this->uri . $post->id);
        $response->assertStatus(200);

        $post = ProjectPost::whereId($post->id)->first();
        $this->assertNull($post);
    }
}
