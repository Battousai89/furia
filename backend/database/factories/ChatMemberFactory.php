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
        return [
            'chat_id' => fake()->randomElement(Chat::query()->pluck('id')->toArray()),
            'user_id' => fake()->randomElement(User::query()->pluck('id')->toArray()),
            'owner' => fake()->boolean(),
            'write' => fake()->boolean(),
            'react' => fake()->boolean(),
            'audio' => fake()->boolean(),
            'video' => fake()->boolean(),
            'files' => fake()->boolean(),
            'invite_members' => fake()->boolean(),
            'accept_members' => fake()->boolean(),
            'remove_members' => fake()->boolean()
        ];
    }
}
