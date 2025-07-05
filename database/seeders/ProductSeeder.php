<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Cheese',
            'is_expirable' => true,
            'is_shippable' => true,
            'weight' => 1.2,
        ]);

        Product::create([
            'name' => 'TV',
            'is_expirable' => false,
            'is_shippable' => true,
            'weight' => 8.5,
        ]);

        Product::create([
            'name' => 'Mobile Scratch Card',
            'is_expirable' => true,
            'is_shippable' => false,
            'weight' => null,
        ]);


        Product::create([
            'name' => 'Mobile',
            'is_expirable' => false,
            'is_shippable' => true,
            'weight' => 0.4,
        ]);


        Product::create([
            'name' => 'Biscuits',
            'is_expirable' => true,
            'is_shippable' => true,
            'weight' => 0.5,
        ]);
    }
}
