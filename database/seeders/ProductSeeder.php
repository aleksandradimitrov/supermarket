<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSpecialPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Product A
        $productA = Product::firstOrCreate(
            ['sku' => 'A'],
            ['name' => 'Item A', 'unit_price' => 5000]
        );

        ProductSpecialPrice::firstOrCreate(
            ['product_id' => $productA->id, 'quantity' => 3],
            ['special_price' => 13000]
        );

        // Seed Product B
        $productB = Product::firstOrCreate(
            ['sku' => 'B'],
            ['name' => 'Item B', 'unit_price' => 3000]
        );

        ProductSpecialPrice::firstOrCreate(
            ['product_id' => $productB->id, 'quantity' => 2],
            ['special_price' => 4500]
        );

        // Seed Product C (no special price)
        Product::firstOrCreate(
            ['sku' => 'C'],
            ['name' => 'Item C', 'unit_price' => 2000]
        );

        // Seed Product D (no special price)
        Product::firstOrCreate(
            ['sku' => 'D'],
            ['name' => 'Item D', 'unit_price' => 1000]
        );
    }
}
