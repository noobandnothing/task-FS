<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\DB;

class CartRepository
{
    static function getOrCreateLatestCart($user)
    {
        return $user->latestCart()->first() ?? $user->carts()->create();
    }


    static function handleCheckoput($user)
    {
        DB::transaction(function () use ($user) {
            $cart = $user->latestCart()->with(['cartItems.productSupplier', 'cartItems.product'])->first();

            if (!$cart || $cart->cartItems->isEmpty()) {
                throw new Exception("Cart is empty.");
            }

            $subtotal = 0;
            $shippingWeight = 0;
            $shipmentLines = [];

            foreach ($cart->cartItems as $item) {
                if ($item->expires_at < now()) {
                    throw new Exception("Item expired: {$item->product->name}");
                }

                $supplier = $item->productSupplier()->lockForUpdate()->first();

                if ($supplier->quantity < $item->quantity) {
                    throw new Exception("Insufficient stock for {$item->product->name}");
                }

                $supplier->decrement('quantity', $item->quantity);

                $subtotal += $item->quantity * $supplier->price;

                if ($item->product->is_shippable) {
                    $shippingWeight += $item->quantity * $item->product->weight;
                    $shipmentLines[] = "{$item->quantity}x {$item->product->name}";
                }
            }

            $shippingFee = ceil($shippingWeight * 20);
            $total = $subtotal + $shippingFee;

            if ($user->balance < $total) {
                throw new Exception("Insufficient balance.");
            }

            $user->decrement('balance', $total);

            $order = Order::create([
                'user_id' => $user->id,
                'cart_id' => $cart->id,
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'total' => $total,
            ]);

            foreach ($cart->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->productSupplier->price,
                ]);

                $item->update(['is_checked_out' => true]);
            }

            $cart->update(['is_checked_out' => true]);

            echo "** Shipment notice **\n";
            foreach ($shipmentLines as $line) echo "$line\n";
            echo "Total package weight " . number_format($shippingWeight / 1000, 2) . "kg\n\n";

            echo "** Checkout receipt **\n";
            foreach ($cart->cartItems as $item) {
                $price = $item->quantity * $item->productSupplier->price;
                echo "{$item->quantity}x {$item->product->name} $price\n";
            }
            echo "----------------------\n";
            echo "Subtotal $subtotal\n";
            echo "Shipping $shippingFee\n";
            echo "Amount $total\n";
            echo "Balance after payment: {$user->fresh()->balance}\n";
        });
    }
}
