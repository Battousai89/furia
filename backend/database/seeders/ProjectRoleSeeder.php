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
        ProjectRole::create([
            'name' => 'default',
            'project_id' => 1,
            'create_posts' => false,
            'edit_posts' => false,
            'remove_posts' => false,
            'create_chats' => false,
            'invite_members' => false,
            'accept_members' => false,
            'remove_members' => false,
            'change_project_name' => false,
            'change_project_preview' => false,
            'change_project_description' => false,
            'change_project_preview_picture' => false,
            'change_project_detail_picture' => false

        ]);
        for ($i = 0; $i < 9; $i++) {
            $projectRole = ProjectRole::factory()->create();
        }
    }
}
