<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('qty', '>', 0)
            ->latest()
            ->paginate(12);

        return response()->json([
            'status' => 'success',
            'products' => $products
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'status' => 'success',
            'product' => $product->load('category')
        ]);
    }
}
