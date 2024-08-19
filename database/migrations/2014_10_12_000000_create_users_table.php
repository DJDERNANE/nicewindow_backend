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
            $table->integer('master_id')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type');
            $table->string('logo')->nullable();
            $table->string('status')->nullable();
            $table->string('phone_number');
            $table->integer('otp_code')->nullable();;
            $table->string('profile_photo_path')->nullable();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo_path')->nullable();
            $table->string('api_token')->nullable();
            $table->string('device_token')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
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
