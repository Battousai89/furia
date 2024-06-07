<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\PostComment;
use App\Models\ProjectPost;
use App\Models\User;
use Tests\TestCase;

class ApiPostCommentsTest extends TestCase
{
    private string $uri = '/api/projects/';

    public function testGetPostComments(): void
    {
        $project = Project::factory()->create();
        $post = ProjectPost::factory()->create(
            ['project_id' => $project->id]
        );
        $user = User::factory()->create();
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            $comment = PostComment::factory()->create([
                'project_post_id' => $post->id,
                'user_id' => $user->id,
                'content' => 'Test content',
                'post_comment_id' => fake()->randomElement([
                    null,
                    ...PostComment::query()->pluck('id')->toArray()
                ]),
            ]);
        }
        $response = $this->get($this->uri . $project->id . '/posts/' . $post->id . '/comments');
        $comments = ProjectPost::whereId($post->id)->first()->comments->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($comments, $content);
    }

    public function testCreatePostComment(): void
    {
        $project = Project::factory()->create();
        $post = ProjectPost::factory()->create(
            ['project_id' => $project->id]
        );
        $user = User::factory()->create();
        $response = $this->post($this->uri . $project->id . '/posts/' . $post->id . '/comments', [
            'project_post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'Test content',
            'post_comment_id' => fake()->randomElement([
                null,
                ...PostComment::query()->pluck('id')->toArray()
            ]),
        ]);
        $content = $response->content();
        $comment = ProjectPost::whereId($post->id)->first()->comments[0];
        $this->assertInstanceOf(PostComment::class, $comment);
        $this->assertJsonStringEqualsJsonString($comment->toJson(), $content);
    }

    public function testGetPostCommentById(): void
    {
        $project = Project::factory()->create();
        $post = ProjectPost::factory()->create(
            ['project_id' => $project->id]
        );
        $user = User::factory()->create();
        $comment = PostComment::factory()->create([
            'project_post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'Test content',
            'post_comment_id' => fake()->randomElement([
                null,
                ...PostComment::query()->pluck('id')->toArray()
            ]),
        ]);
        $response = $this->get($this->uri . $project->id . '/posts/' . $post->id . '/comments/' . $comment->id);
        $content = $response->content();
        $comment = ProjectPost::whereId($post->id)->first()->comments[0];
        $this->assertJsonStringEqualsJsonString($comment->toJson(), $content);
    }

    public function testUpdatePostComment(): void
    {
        $project = Project::factory()->create();
        $post = ProjectPost::factory()->create(
            ['project_id' => $project->id]
        );
        $user = User::factory()->create();

        $comment = PostComment::factory()->create([
            'project_post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'Test Content',
        ]);
        $response = $this->put($this->uri . $project->id . '/posts/' . $post->id . '/comments/' . $comment->id, [
            'project_post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'Content Test',
        ]);
        $response->assertStatus(200);
        $comment = PostComment::whereId($comment->id)->first();
        $this->assertEquals('Content Test', $comment->content);
    }

   public function testDeletePostComment(): void
   {
       $project = Project::factory()->create();
       $post = ProjectPost::factory()->create(
           ['project_id' => $project->id]
       );
       $comment = PostComment::factory()->create();

       $response = $this->delete($this->uri . $project->id . '/posts/' . $post->id . '/comments/' . $comment->id);
       $response->assertStatus(200);

       $comment = PostComment::whereId($post->id)->first();
       $this->assertNull($comment);
   }
}
