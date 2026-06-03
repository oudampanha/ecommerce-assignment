<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\API\FrontController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\Admin\RoleController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\OrderController;
use App\Http\Controllers\API\Admin\SliderController;
use App\Http\Controllers\API\Admin\ProductController;
use App\Http\Controllers\API\Admin\CategoryController;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
  Route::post('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::apiResource('products', App\Http\Controllers\ProductController::class);
Route::apiResource('categories', CategoryController::class);

Route::middleware(['auth:sanctum'])->group(function () {
  // Public routes for frontend
  Route::get('/front/getSiders', [FrontController::class, 'slider']);
  Route::get('/front/getCategories', [FrontController::class, 'category']);
  Route::get('/front/getProductByCategory/{category}', [FrontController::class, 'product']);
  Route::get('/front/getProduct/detailBy/{id}', [FrontController::class, 'detail']);
  Route::get('/front/searchProduct', [FrontController::class, 'serchProduct']);
  Route::get('/front/get_random_product', [FrontController::class, 'getRandomProduct']);
  Route::get('/front/get_random_product_detail/{id}', [FrontController::class, 'getRandomProductDetail']);
  Route::post('auth/logout', [AuthController::class, 'logout']);
  //User Routes
  Route::get('/list', function () {
    return response()->json([
      'status' => 'success',
      'user' => \App\Models\User::all(),
    ]);
  });
  // Admin routes
  Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('order', OrderController::class);
    Route::apiResource('sliders', SliderController::class);
  });
  // // Editor routes
  Route::group(['prefix' => 'editor', 'as' => 'editor.', 'middleware' => ['role:editor']], function () {
    Route::prefix('editor/posts')->controller(PostController::class)->group(function () {
      Route::get('/', 'index');
      Route::get('/{post}', 'show');
      Route::post('/', 'store');
      Route::put('/{post}', 'update');
      Route::delete('/{post}', 'destroy');
    });
  });
  // // User routes
  Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['role:user']], function () {
    // Customer routes
    Route::get('/products', [App\Http\Controllers\API\ProductController::class, 'index']);
    Route::get('/products/{id}', [App\Http\Controllers\API\ProductController::class, 'show']);
    // Order routes
    Route::post('/orders', [App\Http\Controllers\API\OrderController::class, 'store']);
    Route::get('/orders', [App\Http\Controllers\API\OrderController::class, 'index']);
    Route::get('/orders/{order}', [App\Http\Controllers\API\OrderController::class, 'show']);
  });
});