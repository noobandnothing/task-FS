<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cheese = Product::where('name', 'Cheese')->first();
        $tv = Product::where('name', 'TV')->first();
        $scratchCard = Product::where('name', 'Mobile Scratch Card')->first();
        $biscuits = Product::where('name', 'Biscuits')->first();
        $mobilePhone = Product::where('name', 'Mobile')->first();

        $supplierOne = Supplier::where('name', 'Sup One')->first();
        $supplierTwo = Supplier::where('name', 'Sup Two')->first();
        $supplierThree = Supplier::where('name', 'Sup Three')->first();

        // Cheese from 1 and 2
        $cheese->suppliers()->attach([
            $supplierOne->id => [
                'price' => 25.00,
                'quantity' => 100,
                'expire_date' => '2025-12-01',
            ],
            $supplierTwo->id => [
                'price' => 27.50,
                'quantity' => 80,
                'expire_date' => '2025-11-15',
            ],
        ]);

        // TV from 2
        $tv->suppliers()->attach([
            $supplierTwo->id => [
                'price' => 1500.00,
                'quantity' => 20,
                'expire_date' => null,
            ],
        ]);

        // Scratch Card from 3
        $scratchCard->suppliers()->attach([
            $supplierThree->id => [
                'price' => 5.00,
                'quantity' => 500,
                'expire_date' => '2025-09-01',
            ],
        ]);

        // Biscuits from 1
        $biscuits->suppliers()->attach([
            $supplierOne->id => [
                'price' => 10.00,
                'quantity' => 300,
                'expire_date' => '2025-08-20',
            ],
        ]);

        // Mobile from 3
        $mobilePhone->suppliers()->attach([
            $supplierThree->id => [
                'price' => 899.00,
                'quantity' => 40,
                'expire_date' => null,
            ],
        ]);
    }
}
