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
        Schema::create('carpentry_profiles_order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('profile_id');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->integer('profit');
            $table->integer('remise')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpentry_profiles_order_products');
    }
};
