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
        $chat = Chat::factory()->create();
        $chatMember = ChatMember::factory()->create();
        $files = [];
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            $files[] = '"' . $i . '": "' . fake()->filePath() . '"';
        }
        $jsonFiles = !empty($files) ? '{' . implode(',', $files) . '}' : null;

        return [
            'chat_id' => $chat->id,
            'chat_member_id' => $chatMember->id,
            'content' => fake()->realText(),
            'files' => $jsonFiles
        ];
    }
}
