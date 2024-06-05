<?php

namespace Database\Seeders;

use App\Models\ProjectRole;
use Illuminate\Database\Seeder;

class ProjectRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 9; $i++) {
            $projectRole = ProjectRole::factory()->create();
        }
    }
}
