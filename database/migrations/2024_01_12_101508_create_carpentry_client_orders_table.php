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
        Schema::create('carpentry_client_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('carpentry_id');
            $table->integer('client_id');
            $table->integer('total_price');
            $table->integer('promotion')->nullable();
            $table->string('payment_status')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('paye')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpentry_client_orders');
    }
};
