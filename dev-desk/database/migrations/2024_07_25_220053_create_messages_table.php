<?php

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
        Schema::create('messages', function (Blueprint $t) {
            $t->id();
            $t->foreignId('chat_id')->constrained('chats')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $t->text('message');
            // $t->foreignId('sender_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
