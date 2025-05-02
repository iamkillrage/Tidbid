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
        Schema::create('users', function (Blueprint $table) {
                    $table->id();
                    $table->enum('role', ['User', 'Influencer']);
                    $table->string('name')->nullable();
                    $table->string('userName')->nullable();
                    $table->string('email')->unique();
                    $table->string('password');
                    $table->string('phone')->nullable();
                    $table->date('dob')->nullable();
                    $table->string('profile_img')->nullable();
                    $table->longText('bio')->nullable();
                    $table->timestamp('email_verified_at')->nullable();
                    $table->enum('status', ['Inactive', 'Activate']);
                    $table->enum('profile_status', ['Pending', 'Complete']);
                    $table->string('referral_code')->nullable(); 
                    $table->string('customer_id')->nullable(); 
                    $table->enum('agree', [0, 1]);              
                    $table->rememberToken();
                    $table->timestamps();
                    $table->softDeletes();
              });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
