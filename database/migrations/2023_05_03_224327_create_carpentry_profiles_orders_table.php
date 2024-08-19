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
        Schema::create('carpentry_profiles_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('carpentry_id');
            $table->integer('supplier_id');
            $table->string('shipping_address');
            $table->integer('shipping_price')->nullable();
            $table->integer('total_price');
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('paye')->nullable();
            $table->integer('profit')->nullable();
            $table->integer('remise')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpentry_profiles_orders');
    }
};
