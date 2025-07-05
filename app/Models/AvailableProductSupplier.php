<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableProductSupplier extends Model
{
    protected $table = 'available_product_suppliers';

    protected $primaryKey = 'id';
    public $incrementing = false;
}
