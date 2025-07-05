<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'is_expirable',
        'is_shippable',
        'weight',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class)
            ->withPivot(['price', 'quantity', 'expire_date'])
            ->withTimestamps();
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
