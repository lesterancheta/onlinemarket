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
      Schema::table('cart_items', function (Blueprint $table) {
            // Only if you accidentally made user_id the primary key
            $table->dropPrimary(); 

            // Add id column if not present
            if (!Schema::hasColumn('cart_items', 'id')) {
                $table->id()->first();
            }

            // Add a unique constraint to avoid duplicate entries per product per user
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'product_id']);
        });
    }
};
