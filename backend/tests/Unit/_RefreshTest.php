<?php

namespace Tests\Unit;

use Tests\TestCase;

class _RefreshTest extends TestCase
{
    /**
     * Очищает таблицу и выполняет миграции
     * @return void
     */
    public function testRefreshDatabase(): void
    {
        $this->assertNotFalse(exec('php artisan migrate:refresh'));
    }
}
