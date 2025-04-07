<?php

namespace App\Http\Controllers;

use App\Services\PriceCalculator;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $cart = session('cart', []);
        $total = app(PriceCalculator::class)->calculate(implode('', $cart));

        return view('checkout', compact('cart', 'total'));
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
}
