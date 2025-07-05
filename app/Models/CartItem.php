<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_supplier_id',
        'quantity',
        'reserved_at',
        'expires_at',
        'is_checked_out',
    ];

    protected $casts = [
        'reserved_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_checked_out' => 'boolean',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function setReservedAtAttribute($value)
    {
        $this->attributes['reserved_at'] = $value ?? now();
    }

    public function setExpiresAtAttribute($value)
    {
        $this->attributes['expires_at'] = $value ?? now()->addMinutes(10);
    }
}
