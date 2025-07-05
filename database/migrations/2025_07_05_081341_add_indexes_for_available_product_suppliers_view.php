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
        Schema::table('product_supplier', function (Blueprint $table) {
            $table->index('product_id', 'idx_product_supplier_product_id');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->index(['product_supplier_id', 'product_id', 'expires_at'], 'idx_cart_items_supplier_product_expiry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_supplier', function (Blueprint $table) {
            $table->dropIndex('idx_product_supplier_product_id');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropIndex('idx_cart_items_supplier_product_expiry');
        });
    }
};
