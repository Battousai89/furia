<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        match(config('app.env')) {
            'local' => $this->runTestDataSeeders(),
            default => null
        };
    }

    private function runTestDataSeeders()
    {
        $this->call([
            ProjectSeeder::class,
            ProjectRoleSeeder::class,
            ProjectMemberSeeder::class,
            ProjectPostSeeder::class,
            PostCommentSeeder::class,
            ChatSeeder::class,
            ChatMemberSeeder::class,
            ChatMessageSeeder::class,
        ]);
    }
}
