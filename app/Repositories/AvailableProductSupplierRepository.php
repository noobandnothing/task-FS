<?php

namespace App\Repositories;

use App\Models\AvailableProductSupplier;

class AvailableProductSupplierRepository
{

    static function getAvailableProduct($product_id)
    {
        try {
            $available = AvailableProductSupplier::where('product_id', $product_id)->first();
            return $available;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
