<?php

namespace Database\Seeders;

use App\Models\ProjectPost;
use Illuminate\Database\Seeder;

class ProjectPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 9; $i++) {
            $projectMember = ProjectPost::factory()->create();
        }
    }
}
