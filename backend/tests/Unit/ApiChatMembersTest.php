<?php

namespace Tests\Unit;

use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\User;
use Tests\TestCase;

class ApiChatMembersTest extends TestCase
{
    private string $uri = '/api/chats/members/';

    public function testGetChatMembers(): void
    {
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            ChatMember::factory()->create();
        }
        $response = $this->get($this->uri);
        $members = ChatMember::query()->get()->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($members, $content);
    }

    public function testCreateChatMember(): void
    {
        $user = User::factory()->create();
        $response = $this->post($this->uri, [
            'user_id' => $user->id,
            'chat_id' => Chat::factory()->create()->id,
            'is_owner' => fake()->boolean(),
            'is_can_write' => fake()->boolean(),
            'is_can_send_react' => fake()->boolean(),
            'is_can_send_audio' => fake()->boolean(),
            'is_can_send_video' => fake()->boolean(),
            'is_can_send_files' => fake()->boolean(),
            'is_can_invite_members' => fake()->boolean(),
            'is_can_accept_members' => fake()->boolean(),
            'is_can_remove_members' => fake()->boolean(),
        ]);
        $content = $response->content();
        $member = User::whereId($user->id)->first()->chatGroups[0];
        $this->assertInstanceOf(ChatMember::class, $member);
        $this->assertJsonStringEqualsJsonString($member->toJson(), $content);
    }

    public function testGetChatMemberById(): void
    {
        $user = User::factory()->create();
        $member = ChatMember::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->get($this->uri . $member->id);
        $content = $response->content();
        $member = User::whereId($user->id)->first()->chatGroups[0];
        $this->assertJsonStringEqualsJsonString($member->toJson(), $content);
    }

    public function testUpdateChatMember(): void
    {
        $user = User::factory()->create();
        $member = ChatMember::factory()->create([
            'user_id' => $user->id,
            'is_owner' => false,
        ]);
        $response = $this->put($this->uri . $member->id, [
            'chat_id' => $member->chat->id,
            'user_id' => $member->user->id,
            'is_owner' => true,
            'is_can_write' => $member->is_can_write,
            'is_can_send_react' => $member->is_can_send_react,
            'is_can_send_audio' => $member->is_can_send_audio,
            'is_can_send_video' => $member->is_can_send_video,
            'is_can_send_files' => $member->is_can_send_files,
            'is_can_invite_members' => $member->is_can_invite_members,
            'is_can_accept_members' => $member->is_can_accept_members,
            'is_can_remove_members' => $member->is_can_remove_members,
        ]);
        $response->assertStatus(200);

        $member = ChatMember::whereId($member->id)->first();
        $this->assertEquals($user->id, $member->user->id);
        $this->assertTrue($member->is_owner);
    }

    public function testDeleteChatMember(): void
    {
        $member = ChatMember::factory()->create();

        $response = $this->delete($this->uri . $member->id);
        $response->assertStatus(200);

        $member = ChatMember::whereId($member->id)->first();
        $this->assertNull($member);
    }
}
