<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Project;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Project::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->boolean('create_posts')->default(false);
            $table->boolean('edit_posts')->default(false);
            $table->boolean('remove_posts')->default(false);
            $table->boolean('create_chats')->default(false);
            $table->boolean('invite_members')->default(false);
            $table->boolean('accept_members')->default(false);
            $table->boolean('remove_members')->default(false);
            $table->boolean('change_project_name')->default(false);
            $table->boolean('change_project_preview')->default(false);
            $table->boolean('change_project_description')->default(false);
            $table->boolean('change_project_preview_picture')->default(false);
            $table->boolean('change_project_detail_picture')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_roles');
    }
};
