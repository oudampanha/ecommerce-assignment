<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
  public function index()
  {
    // $categories = Category::withCount('products')->latest()->paginate(10);
    // return response()->json([
    //   'status' => 'success',
    //   'categories' => $categories
    // ]);
    return CategoryResource::collection(Category::withCount('products')->latest()->get());
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255|unique:categories,name',
      'description' => 'nullable|string',
      'category_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $validated['category_image'] = $request->file('category_image')->store('categories', 'public');
    $category = Category::create($validated);

    return response()->json([
      'status' => 'success',
      'message' => 'Category created successfully',
      'category' => $category
    ], 201);
  }

  public function show(Category $category)
  {
    return response()->json([
      'status' => 'success',
      'category' => $category->load(['products' => function ($query) {
        $query->latest()->paginate(10);
      }])
    ]);
  }

  public function update(Request $request, Category $category)
  {
    $validated = $request->validate([
      'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $category->id,
      'description' => 'sometimes|required|string',
      'category_image' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if ($request->hasFile('category_image')) {
      Storage::disk('public')->delete($category->category_image);
      $validated['category_image'] = $request->file('category_image')->store('categories', 'public');
    }

    $category->update($validated);

    return response()->json([
      'status' => 'success',
      'message' => 'Category updated successfully',
      'category' => $category->fresh()
    ]);
  }

  public function destroy(Category $category)
  {
    if ($category->products()->exists()) {
      return response()->json([
        'status' => 'error',
        'message' => 'Cannot delete category with associated products'
      ], 409);
    }

    Storage::disk('public')->delete($category->category_image);
    $category->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'Category deleted successfully'
    ]);
  }
}
