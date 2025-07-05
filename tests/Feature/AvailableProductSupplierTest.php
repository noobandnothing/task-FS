<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Repositories\AvailableProductSupplierRepository;
use Tests\TestCase;

class AvailableProductSupplierTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $cheese = Product::where('name', 'Cheese')->firstOrFail();

        $available = AvailableProductSupplierRepository::getAvailableProduct($cheese->id);

        if($available){
            dump($available->toArray());
            dump($available->id);
            dump($available->product_id);
            
        }else
            dump("nothing");


    }
}
