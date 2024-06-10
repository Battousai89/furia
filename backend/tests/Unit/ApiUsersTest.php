<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class ApiUsersTest extends TestCase
{
    private string $uri = '/api/users/';

    public function testGetUsers(): void
    {
        $response = $this->get($this->uri);
        $users = User::all()->toJson();
        $content = $response->content();
        $this->assertJsonStringEqualsJsonString($users, $content);
    }

    public function testCreateUser(): void
    {
        $response = $this->post($this->uri, [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'email_verified_at' => null,
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);
        $content = $response->content();
        $user = User::whereEmail('test@test.com')->first();

        $this->assertInstanceOf(User::class, $user);
        $this->assertJsonStringEqualsJsonString($user->toJson(), $content);
    }

    public function testGetUserById(): void
    {
        $user = User::factory()->create();
        $response = $this->get($this->uri . $user->id);
        $content = $response->content();
        $user->toJson();
        $this->assertJsonStringEqualsJsonString($user, $content);
    }

    public function testUpdateUser(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
        ]);
        $response = $this->put($this->uri . $user->id, [
            'name' => 'User Test',
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'password' => $user->password,
            'remember_token' => $user->remember_token,
        ]);
        $response->assertStatus(200);

        $user = User::whereId($user->id)->first();
        $this->assertEquals('User Test', $user->name);
    }

    public function testDeleteUser(): void
    {
        $user = User::factory()->create();
        $response = $this->delete($this->uri . $user->id);
        $response->assertStatus(200);

        $user = User::whereId($user->id)->first();
        $this->assertNull($user);
    }
}
