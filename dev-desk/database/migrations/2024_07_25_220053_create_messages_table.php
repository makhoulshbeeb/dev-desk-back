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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('username')->references('username_1')->on('chats')->onDelete('cascade')->onUpdate('cascade'); 
            $table->text('message');
            // $table->foreignId('sender_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
