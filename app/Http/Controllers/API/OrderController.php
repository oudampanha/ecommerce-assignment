<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
  public function store(Request $request)
  {
    $validated = $request->validate([
      'products' => 'required|array',
      'products.*.product_id' => 'required|exists:products,id',
      'products.*.qty' => 'required|integer|min:1',
      'restaurant_id' => 'nullable|exists:restaurants,id',
      'delivery_address' => 'required|string|max:500',
      'latitude' => 'nullable|numeric|between:-90,90',
      'longitude' => 'nullable|numeric|between:-180,180',
      'payment_method' => 'nullable|string|in:cod,card,wallet',
      'delivery_fee' => 'nullable|numeric|min:0',
      'notes' => 'nullable|string|max:1000'
    ]);

    try {
      DB::beginTransaction();

      $deliveryFee = $validated['delivery_fee'] ?? 2.00;
      $totalAmount = $deliveryFee;
      $restaurantId = $validated['restaurant_id'] ?? null;

      $orderDetails = [];

      // Validate quantities and calculate total payment amount
      foreach ($validated['products'] as $productData) {
        $product = Product::findOrFail($productData['product_id']);

        if ($product->qty < $productData['qty']) {
          return response()->json([
            'status' => 'error',
            'message' => "Insufficient quantity for product ID {$productData['product_id']}"
          ], 400);
        }

        // If restaurant ID was not specified, infer it from the first product
        if (!$restaurantId && $product->restaurant_id) {
          $restaurantId = $product->restaurant_id;
        }

        $orderDetails[] = [
          'product' => $product,
          'qty' => $productData['qty']
        ];

        $totalAmount += $product->price * $productData['qty'];
      }

      // Create the food delivery progress tracked order
      $order = Order::create([
        'user_id' => Auth::id(),
        'restaurant_id' => $restaurantId,
        'order_date' => now(),
        'status' => 'pending', // Food delivery flow starts at pending
        'delivery_address' => $validated['delivery_address'],
        'latitude' => $validated['latitude'] ?? null,
        'longitude' => $validated['longitude'] ?? null,
        'delivery_fee' => $deliveryFee,
        'total_amount' => $totalAmount,
        'payment_method' => $validated['payment_method'] ?? 'cod',
        'payment_status' => 'pending',
        'notes' => $validated['notes'] ?? null,
      ]);

      // Save details and decrement inventory
      foreach ($orderDetails as $item) {
        $item['product']->decrement('qty', $item['qty']);

        OrderDetails::create([
          'order_id' => $order->id,
          'product_id' => $item['product']->id,
          'qty' => $item['qty']
        ]);
      }

      DB::commit();

      return response()->json([
        'status' => 'success',
        'message' => 'Your food order has been placed successfully!',
        'order' => $order->load(['orderDetails.product', 'restaurant'])
      ], 201);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'status' => 'error',
        'message' => 'Failed to place food order',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function index()
  {
    $orders = Order::with(['orderDetails.product', 'restaurant', 'driver'])
      ->where('user_id', Auth::id())
      ->latest()
      ->paginate(10);

    return response()->json([
      'status' => 'success',
      'orders' => $orders
    ]);
  }

  public function show(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized access'
      ], 403);
    }

    return response()->json([
      'status' => 'success',
      'order' => $order->load(['orderDetails.product', 'restaurant', 'driver'])
    ]);
  }

  /**
   * Cancel an order in standard progress state
   */
  public function cancel(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized access'
      ], 403);
    }

    if ($order->status !== 'pending') {
      return response()->json([
        'status' => 'error',
        'message' => 'Order cannot be cancelled once accepted or prepared.'
      ], 400);
    }

    try {
      DB::beginTransaction();

      $order->update(['status' => 'cancelled']);

      // Revert product quantities
      foreach ($order->orderDetails as $detail) {
        if ($detail->product) {
          $detail->product->increment('qty', $detail->qty);
        }
      }

      DB::commit();

      return response()->json([
        'status' => 'success',
        'message' => 'Order cancelled successfully.',
        'order' => $order
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'status' => 'error',
        'message' => 'Failed to cancel order',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
