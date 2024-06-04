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
        return [
            'project_post_id' => fake()->randomElement(ProjectPost::query()->pluck('id')->toArray()),
            'user_id' => fake()->randomElement(User::query()->pluck('id')->toArray()),
            'content' => fake()->text(),
            'post_comment_id' => fake()->randomElement(PostComment::query()->pluck('id')->toArray()),
        ];
    }
}
