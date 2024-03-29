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
            $table->string('name');
            $table->string('email', 191)->nullable()->default(null)->unique();
            $table->string('address')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'waiter', 'chef', 'user'])->default('user');
            $table->string('phone')->nullable();
            $table->string('status')->default('active');

            $table->foreignId('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('files')->onDelete('cascade');
            
            $table->string('phone_verification_code')->nullable();
            $table->timestamp('phone_verification_sent_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            
            $table->string('email_verification_code')->nullable();
            $table->timestamp('email_verification_sent_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            
            $table->rememberToken();
            $table->timestamps();

            $table->string('otp')->nullable();
            $table->timestamp('otp_sent_at')->nullable();
            $table->timestamp('otp_verified_at')->nullable();

            $table->string('temp_token')->nullable();
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
