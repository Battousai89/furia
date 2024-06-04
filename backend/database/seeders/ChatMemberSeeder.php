<?php

namespace Database\Seeders;

use App\Models\ChatMember;
use Illuminate\Database\Seeder;

class ChatMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 19; $i++) {
            $chat = ChatMember::factory()->create();
        }
    }
}
