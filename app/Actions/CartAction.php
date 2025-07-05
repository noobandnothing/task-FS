<?php

namespace App\Actions;

use App\Models\CartItem;
use App\Repositories\AvailableProductSupplierRepository;
use App\Repositories\CartRepository;

class CartAction
{

    static function addProduct($user, $product)
    {
        $available = AvailableProductSupplierRepository::getAvailableProduct($product->id);
        if (!$available) {
            return null;
        }
        $cart = CartRepository::getOrCreateLatestCart($user);

        return CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'product_supplier_id' => $available->id,
            'quantity' => 1,
            'reserved_at' => now(),
            'expires_at' => now()->addMinutes(10),
            'is_checked_out' => false,
        ]);
    }



    public static function checkout($user)
    {
        CartRepository::getOrCreateLatestCart($user);
    }
}
