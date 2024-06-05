<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatMember>
 */
class ChatMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $chat = Chat::factory()->create();
        $user = User::factory()->create();
        return [
            'chat_id' => $chat->id,
            'user_id' => $user->id,
            'is_owner' => fake()->boolean(),
            'is_can_write' => fake()->boolean(),
            'is_can_send_react' => fake()->boolean(),
            'is_can_send_audio' => fake()->boolean(),
            'is_can_send_video' => fake()->boolean(),
            'is_can_send_files' => fake()->boolean(),
            'is_can_invite_members' => fake()->boolean(),
            'is_can_accept_members' => fake()->boolean(),
            'is_can_remove_members' => fake()->boolean()
        ];
    }
}
