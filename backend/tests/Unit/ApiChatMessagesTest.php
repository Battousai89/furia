<?php

namespace Tests\Unit;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatMember;
use Tests\TestCase;

class ApiChatMessagesTest extends TestCase
{
    private string $uri = '/api/chats/messages/';

    public function testGetChatMessages(): void
    {
        for ($i = 0; $i < fake()->numberBetween(0, 19); $i++) {
            ChatMessage::factory()->create();
        }
        $response = $this->get($this->uri);
        $messages = ChatMessage::query()->get()->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($messages, $content);
    }

    public function testCreateChatMessage(): void
    {
        $chat = Chat::factory()->create();
        $response = $this->post($this->uri, [
            'chat_id' => $chat->id,
            'chat_member_id' => fake()->randomElement([null, ChatMember::factory()->create()->id]),
            'content' => fake()->text(),
            'files' => fake()->randomElement([null, json_encode(fake()->filePath())]),
        ]);
        $content = $response->content();
        $message = Chat::whereId($chat->id)->first()->messages[0];
        $this->assertInstanceOf(ChatMessage::class, $message);
        $this->assertJsonStringEqualsJsonString($message->toJson(), $content);
    }

    public function testGetChatMessageById(): void
    {
        $member = ChatMember::factory()->create();
        $message = ChatMessage::factory()->create([
            'chat_member_id' => $member->id,
        ]);
        $response = $this->get($this->uri . $message->id);
        $content = $response->content();
        $message = ChatMember::whereId($member->id)->first()->messages[0];
        $this->assertJsonStringEqualsJsonString($message->toJson(), $content);
    }

    public function testUpdateChatMessage(): void
    {
        $member = ChatMember::factory()->create();
        $message = ChatMessage::factory()->create([
            'chat_member_id' => $member->id,
            'content' => fake()->text(),
        ]);
        $response = $this->put($this->uri . $message->id, [
            'chat_id' => $message->chat->id,
            'chat_member_id' => $message->owner->id,
            'content' => 'Test Content',
            'files' => null,
        ]);
        $response->assertStatus(200);

        $message = ChatMessage::whereId($message->id)->first();
        $member->delete();
        $this->assertNull($message->owner);
        $this->assertEquals('Test Content', $message->content);
    }

    public function testDeleteChatMessage(): void
    {
        $message = ChatMessage::factory()->create();

        $response = $this->delete($this->uri . $message->id);
        $response->assertStatus(200);

        $message = ChatMessage::whereId($message->id)->first();
        $this->assertNull($message);
    }
}
