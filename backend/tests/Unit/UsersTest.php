<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UsersTest extends TestCase
{
    /**
     * Очищает таблицу и выполняет миграции
     * @return void
     */
    public function testRefreshDatabase(): void
    {
        $this->assertNotFalse(exec('php artisan migrate:refresh'));
    }

    /**
     * Проверяет корректность создания пользователя
     * @return void
     */
    public function testCreateUser(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * Проверяет корректность удаления пользователя
     * @return void
     */
    public function testDeleteUser(): void
    {
        $user = User::factory()->create();
        $userId = $user->id;
        $user->delete();
        $user = User::whereId($userId)->first();
        $this->assertNull($user);
    }
}
