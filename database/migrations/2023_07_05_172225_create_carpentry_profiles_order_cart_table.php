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
        Schema::create('carpentry_profiles_order_cart', function (Blueprint $table) {
            $table->id();
            $table->integer('carpentry_id');
            $table->integer('supplier_id');
            $table->integer('profile_id');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpentry_profiles_order_cart');
    }
};
