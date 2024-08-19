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
        Schema::table('supplier_profiles_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('typeId');
            $table->foreign('typeId')
                ->references('id')
                ->on('types');
        });
        Schema::table('supplier_profiles_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('colorId');
            $table->foreign('colorId')
                ->references('id')
                ->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_stock', function (Blueprint $table) {

            $table->dropForeign(['typeId']);
            $table->dropColumn('typeId');
            $table->dropForeign(['colorId']);
            $table->dropColumn('colorId');
        });
    }
};
