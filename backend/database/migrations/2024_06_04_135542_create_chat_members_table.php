<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Chat::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_owner');
            $table->boolean('is_can_write');
            $table->boolean('is_can_send_react');
            $table->boolean('is_can_send_audio');
            $table->boolean('is_can_send_video');
            $table->boolean('is_can_send_files');
            $table->boolean('is_can_invite_members');
            $table->boolean('is_can_accept_members');
            $table->boolean('is_can_remove_members');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_members');
    }
};
