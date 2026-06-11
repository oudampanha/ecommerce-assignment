<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  public function index()
  {
    return ProductResource::collection(Product::all());
  }

  // In ProductController.php

  public function store(Request $request)
  {
    $validated = $request->validate([
      'product_name' => 'required|string|max:255',
      'product_description' => 'required|string',
      'qty' => 'required|integer|min:0',
      'price' => 'required|numeric|min:0',
      'star' => 'required|numeric|min:0|max:5',
      'time_value' => 'required|integer',
      'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      'category_id' => 'required|exists:categories,id'
    ]);

    try {
      if ($request->hasFile('product_image')) {
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $imageName = Str::lower(Str::slug($validated['product_name']).'_'.uniqid()) .'.'.$extension;
        $imagePath = $request->file('product_image')->storeAs('products', $imageName, 'public');

        if (!$imagePath) {
            throw new \Exception('Failed to store image.');
        }

        $validated['product_image'] = 'storage/' . $imagePath;
    }

      $product = Product::create($validated);
      return response()->json([
        'status' => 'success',
        'data' => ProductResource::collection(collect([$product])) // Single product
      ]);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error processing image: ' . $e->getMessage()], 500);
    }
  }

  public function show(Product $product)
  {
    return response()->json([
      'status' => 'success',
      'data' => ProductResource::collection(collect([$product])) // Wrap the single product in an array
    ]);
  }


  public function update(Request $request, Product $product)
  {
    // Log::info('Update Request Data:', request()->all());
    // Validate incoming request data
    $validated = $request->validate([
      'product_name' => 'sometimes|string|max:255',
      'product_description' => 'sometimes|string',
      'qty' => 'sometimes|integer|min:0',
      'price' => 'sometimes|numeric|min:0',
      'star' => 'sometimes|numeric|min:0|max:5',
      'time_value' => 'sometimes|integer',
      'category_id' => 'sometimes|exists:categories,id'
    ]);
    $old_mage = 'products/'.basename($product->product_image);
    // Handle image upload if a new image is provided
    if ($request->hasFile('product_image')) {
      // Delete old product image
      Storage::disk('public')->delete($old_mage);
      // Store the new image and save its path
      $extension = $request->file('product_image')->getClientOriginalExtension();
      $imageName = Str::lower(Str::slug($validated['product_name']).'_'.uniqid()) .'.'.$extension;
      $imagePath = $request->file('product_image')->storeAs('products', $imageName, 'public');
      $validated['product_image'] = 'storage/' . $imagePath;
    } else {
      $validated['product_image'] =  'storage/products/'.basename($product->product_image);
    }
    // Update the product with the validated data
    $product->update($validated);

    return response()->json([
      'status' => 'success',
      'data' => ProductResource::collection(collect([$product])) // Single product
    ]);
  }

  public function destroy(Product $product)
  {
    Storage::disk('public')->delete($product->product_image);
    $product->delete();
    return response()->json([
      'status' => 'success',
      'message' => 'Product deleted successfully'
    ]);
  }
}
