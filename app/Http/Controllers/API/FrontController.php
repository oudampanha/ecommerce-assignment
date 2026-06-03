<?php

namespace App\Http\Controllers\API;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class FrontController extends Controller
{
  public function slider()
  {
    $sliders = Slider::latest()->get();
    return response()->json([
      'status' => 'success',
      'sliders' => $sliders
    ]);
  }

  public function category()
  {
    $categories = Category::withCount('products')
      ->latest()
      ->get();
    return response()->json([
      'status' => 'success',
      'categories' => CategoryResource::collection($categories)
    ]);
  }

  public function product($category)
  {
    $products = Product::with('category')
      ->where('category_id', $category)
      ->where('qty', '>', 0)
      ->latest()->get();
    return response()->json([
      'status' => 'success',
      'products' => ProductResource::collection($products)
    ]);
  }

  public function detail($id)
  {
    $products = Product::with('category')
      ->findOrFail($id);
    return response()->json([
      'status' => 'success',
      'meals' => ProductResource::collection(collect([$products])) // Wrap the single product in an array
    ]);
  }

  public function getRandomProduct()
  {
    $products = Product::inRandomOrder()->get();
    return response()->json([
      'status' => 'success',
      'meals' => ProductResource::collection($products)
    ]);
  }

  public function getRandomProductDetail($id)
  {
    $products = Product::findOrFail($id);
    return response()->json([
      'status' => 'success',
      'meals' => ProductResource::collection(collect([$products])) // Wrap the single product in an array
    ]);
  }

  public function serchProduct(Request $request)
  {
    $query = $request->input('filter');
    $products = Product::where('product_name', 'like', '%' . $query . '%')
      ->where('qty', '>', 0)
      ->latest()
      ->paginate(12);
    return response()->json([
      'status' => 'success',
      'meals' => ProductResource::collection($products)
    ]);
  }
}
