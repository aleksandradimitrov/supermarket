<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\PriceCalculator;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $cart = session('cart', []);
        $total = app(PriceCalculator::class)->calculate(implode('', $cart));
        $products = Product::with('specialPrices')->get();

        return view('checkout', compact('cart', 'total', 'products'));
    }

    public function scan(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|alpha|size:1|exists:products,sku'
        ]);

        $sku = strtoupper($validated['sku']);

        $cart = session('cart', []);
        $cart[] = $sku;
        session(['cart' => $cart]);

        return redirect('/');
    }

    public function resetCart()
    {
        session()->forget('cart');
        return redirect('/');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/')->withErrors('Cart is empty.');
        }

        $skus = array_count_values($cart);
        $total = app(PriceCalculator::class)->calculate(implode('', $cart));

        $order = Order::create([
            'total_price' => $total,
            'status' => 'created',
        ]);

        foreach ($skus as $sku => $quantity) {
            $product = Product::where('sku', $sku)->first();
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->unit_price * $quantity, // basic calculation (could be improved)
                ]);
            }
        }

        session()->forget('cart');

        return redirect('/')->with('success', "Order #{$order->id} placed successfully.");
    }
}
