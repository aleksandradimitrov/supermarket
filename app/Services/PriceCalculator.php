<?php

namespace App\Services;

use App\Models\Product;

class PriceCalculator
{
    public function calculate(string $skus): int
    {
        $counts = array_count_values(str_split($skus));
        $total = 0;

        foreach ($counts as $sku => $qty) {
            $product = Product::with('specialPrices')->where('sku', $sku)->first();

            if (!$product) continue;

            $unitPrice = $product->unit_price;
            $specials = $product->specialPrices->sortByDesc('quantity');

            foreach ($specials as $special) {
                if ($qty >= $special->quantity) {
                    $numOfDeals = intdiv($qty, $special->quantity);
                    $total += $numOfDeals * $special->special_price;
                    $qty %= $special->quantity;
                }
            }

            $total += $qty * $unitPrice;
        }

        return $total;
    }
}
