<?php

namespace Database\Factories;

use App\Models\PostComment;
use App\Models\ProjectPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostComment>
 */
class PostCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = ProjectPost::factory()->create();
        $postComments = PostComment::query()->pluck('id')->toArray();
        $user = User::factory()->create();
        return [
            'project_post_id' => $post->id,
            'user_id' => $user->id,
            'content' => fake()->text(),
            'post_comment_id' => fake()->randomElement([null, ...$postComments]),
        ];
    }
}
