<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ChatMember;
use App\Models\Chat;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdfor(Chat::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdfor(ChatMember::class)->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->text('content');
            $table->json('files');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
