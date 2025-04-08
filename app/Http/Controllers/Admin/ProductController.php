<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSpecialPrice;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|max:10|unique:products',
            'name' => 'required|string',
            'unit_price' => 'required|integer|min:1'
        ]);

        Product::create($request->only(['sku', 'name', 'unit_price']));
        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $product->load('specialPrices');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|max:10|unique:products,sku,' . $product->id,
            'name' => 'required|string',
            'unit_price' => 'required|integer|min:1',
        ]);

        $product->update($request->only(['sku', 'name', 'unit_price']));

        // 1. Update/Delete existing specials
        if ($request->has('specials')) {
            foreach ($request->specials as $specialData) {
                $special = ProductSpecialPrice::find($specialData['id'] ?? null);
                if ($special && $special->product_id == $product->id) {
                    if (!empty($specialData['delete'])) {
                        $special->delete();
                    } else {
                        $special->update([
                            'quantity' => $specialData['quantity'],
                            'special_price' => $specialData['special_price'],
                        ]);
                    }
                }
            }
        }

        // 2. Add new specials
        if ($request->has('specials_new')) {
            foreach ($request->specials_new as $newSpecial) {
                if (!empty($newSpecial['quantity']) && !empty($newSpecial['special_price'])) {
                    ProductSpecialPrice::create([
                        'product_id' => $product->id,
                        'quantity' => $newSpecial['quantity'],
                        'special_price' => $newSpecial['special_price'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
