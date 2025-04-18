<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\ProductSpecialPrice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProductSeeder::class);
        // Seed Product A
        $productA = Product::firstOrCreate(
            ['sku' => 'A'],
            ['name' => 'Item A', 'unit_price' => 50]
        );

        ProductSpecialPrice::firstOrCreate(
            ['product_id' => $productA->id, 'quantity' => 3],
            ['special_price' => 130]
        );

        // Seed Product B
        $productB = Product::firstOrCreate(
            ['sku' => 'B'],
            ['name' => 'Item B', 'unit_price' => 30]
        );

        ProductSpecialPrice::firstOrCreate(
            ['product_id' => $productB->id, 'quantity' => 2],
            ['special_price' => 45]
        );

        // Seed Product C (no special price)
        Product::firstOrCreate(
            ['sku' => 'C'],
            ['name' => 'Item C', 'unit_price' => 20]
        );

        // Seed Product D (no special price)
        Product::firstOrCreate(
            ['sku' => 'D'],
            ['name' => 'Item D', 'unit_price' => 10]
        );
    }
}
