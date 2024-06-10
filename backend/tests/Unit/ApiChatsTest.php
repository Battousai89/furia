<?php

namespace Tests\Unit;

use App\Models\Chat;
use App\Models\Project;
use Tests\TestCase;

class ApiChatsTest extends TestCase
{
    private string $uri = '/api/chats/';

    public function testGetChats(): void
    {
        $response = $this->get($this->uri);
        $chats = Chat::all()->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($chats, $content);
    }

    public function testCreateChat(): void
    {
        $response = $this->post($this->uri, [
            'title' => 'Test Chat',
            'project_id' => fake()->randomElement([null, Project::factory()->create()->id]),
            'description' => fake()->randomElement([null, 'Test Description']),
            'picture' => fake()->randomElement([null, fake()->filePath()])
        ]);
        $content = $response->content();
        $chat = Chat::whereTitle('Test Chat')->first();
        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertJsonStringEqualsJsonString($chat->toJson(), $content);
    }

    public function testGetChatById(): void
    {
        $chat = Chat::factory()->create();
        $response = $this->get($this->uri . $chat->id);
        $content = $response->content();
        $chat->toJson();
        $this->assertJsonStringEqualsJsonString($chat, $content);
    }

    public function testUpdateChat(): void
    {
        $chat = Chat::factory()->create([
            'title' => 'Test Chat',
            'description' => null,
        ]);
        $response = $this->put($this->uri . $chat->id, [
            'title' => 'Chat Test',
            'description' => 'Test Description',
        ]);
        $response->assertStatus(200);

        $chat = Chat::whereId($chat->id)->first();
        $this->assertEquals('Chat Test', $chat->title);
        $this->assertEquals('Test Description', $chat->description);
    }

    public function testDeleteChat(): void
    {
        $chat = Chat::factory()->create();
        $response = $this->delete($this->uri . $chat->id);
        $response->assertStatus(200);

        $chat = Chat::whereId($chat->id)->first();
        $this->assertNull($chat);
    }
}
