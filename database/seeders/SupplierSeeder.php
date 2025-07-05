<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create(['name' => 'Sup One']);
        Supplier::create(['name' => 'Sup Two']);
        Supplier::create(['name' => 'Sup Three']);
    }
}
