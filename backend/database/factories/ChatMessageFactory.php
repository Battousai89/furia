<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\ChatMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatMessage>
 */
class ChatMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chat_id' => fake()->randomElement(Chat::query()->pluck('id')->toArray()),
            'chat_member_id' => fake()->randomElement(ChatMember::query()->pluck('id')->toArray()),
            'content' => fake()->realText(),
            'files' => '{ ' . "\n" .
                '"0": "' . fake()->filePath() . '",' . "\n" .
                '"1": "' . fake()->filePath() . '"}',
        ];
    }
}
