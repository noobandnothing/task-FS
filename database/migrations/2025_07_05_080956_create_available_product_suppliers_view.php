<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(<<<SQL
            CREATE VIEW available_product_suppliers AS
            SELECT 
                ps.id AS id,
                ps.product_id,
                ps.quantity,
                ps.expire_date,
                IFNULL(SUM(
                    CASE 
                        WHEN ci.expires_at > NOW() THEN ci.quantity
                        ELSE 0
                    END
                ), 0) AS reserved_quantity,
                (ps.quantity - IFNULL(SUM(
                    CASE 
                        WHEN ci.expires_at > NOW() THEN ci.quantity
                        ELSE 0
                    END
                ), 0)) AS actual_quantity
            FROM product_supplier ps
            LEFT JOIN cart_items ci 
                ON ps.id = ci.product_supplier_id AND ps.product_id = ci.product_id
            GROUP BY ps.id, ps.product_id, ps.quantity, ps.expire_date
            HAVING actual_quantity > 0
            ORDER BY ps.expire_date ASC
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_product_suppliers_view');
    }
};
