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
        Schema::create('agora_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agora_chats_id')->constrained('agora_chats');
            $table->foreignId('reciver_id')->constrained('users');
            $table->foreignId('sender_id')->constrained('users');
            $table->longText('message')->nullable();
            $table->timestamp('message_date_time')->useCurrent(); // Add this line
            $table->timestamps();
            $table->softDeletes();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agora_messages');
    }
};
