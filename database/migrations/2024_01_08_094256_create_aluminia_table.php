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
        Schema::create('aluminia', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('white_price');
            $table->integer('colored_price');
            $table->integer('Carpentry_Id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluminia');
    }
};
