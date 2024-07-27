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
        Schema::create('chats', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id_1')->nullable()->constrained("users")->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('user_id_2')->nullable()->constrained("users")->onDelete('cascade')->onUpdate('cascade');
            // $t->foreignId('sender_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            // $t->foreignId('receiver_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
