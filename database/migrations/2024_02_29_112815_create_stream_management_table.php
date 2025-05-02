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
        Schema::create('stream_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('users');
            $table->string('streamTitle')->nullable();

            $table->date('streamDate')->nullable();
            $table->time('streamTime')->nullable();
            $table->decimal('baseBidPrice', 10, 2)->nullable();
            $table->longText('what_to_expect')->nullable();
            $table->longText('term_and_conditions')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->string('thumbnail_img')->nullable();
            $table->enum('event_status', ['Live_Streams', 'Upcoming_Streams', 'Past_Streams'])->default('Pending');
            $table->enum('status', ['Inactive', 'Activate']);
            $table->timestamp('streamDateTime')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stream_management');
    }
};
