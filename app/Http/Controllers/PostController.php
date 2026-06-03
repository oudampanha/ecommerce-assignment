<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  // public function uploadUrl(Request $request)
  // {
  //   $validatedData = $request->validate([
  //     'title' => 'required|string|max:255',
  //     'content' => 'required|string',
  //     'image_url' => 'nullable|url',
  //   ]);
  //   $post = Post::create($validatedData);
  //   return response()->json($post, 201);
  // }

  public function index(Request $request)
  {
    $posts = Post::paginate(10);
    return response()->json($posts);
  }

  // public function store(Request $request)
  // {
  //   $validatedData = $request->validate([
  //     'title' => 'required|string|max:255',
  //     'content' => 'required|string',
  //     'image_url' => 'nullable|url',
  //   ]);

  //   $post = Post::create($validatedData);
  //   return response()->json($post, 201);
  // }
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'image_path' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validate the image
    ]);
    $imagePath = null;
    if ($request->hasFile('image_path')) {
      $imagePath = $request->file('image_path')->store('images', 'public'); // Save image in public storage
    }
    $post = Post::create([
      'title' => $request->title,
      'content' => $request->content,
      'image_path' => $imagePath,
    ]);

    return response()->json($post, 201);
  }


  public function show($id)
  {
    $post = Post::findOrFail($id);
    return response()->json($post);
  }

  // public function update(Request $request, $id)
  // {
  //   $validatedData = $request->validate([
  //     'title' => 'required|string|max:255',
  //     'content' => 'required|string',
  //     'image_url' => 'nullable|url',
  //   ]);

  //   $post = Post::findOrFail($id);
  //   $post->update($validatedData);
  //   return response()->json($post);
  // }
  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post = Post::findOrFail($id);

    if ($request->hasFile('image')) {
      // Delete old image if it exists
      if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
        Storage::disk('public')->delete($post->image_path);
      }

      // Store new image
      $imagePath = $request->file('image')->store('images', 'public');
      $validatedData['image_path'] = $imagePath;
    }

    $post->update($validatedData);

    return response()->json([
      'success' => true,
      'message' => 'Post updated successfully.',
      'post' => $post,
    ]);
  }

  // public function destroy($id)
  // {
  //   Post::destroy($id);
  //   return response()->json(['message' => 'Post deleted']);
  // }
  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    // Check if the post has an image and delete it from storage
    if ($post->image_path && file_exists(storage_path('app/public/' . $post->image_path))) {
      unlink(storage_path('app/public/' . $post->image_path));
    }
    // Delete the post from the database
    $post->delete();
    return response()->json(['message' => 'Post and associated image deleted successfully.']);
  }
}
