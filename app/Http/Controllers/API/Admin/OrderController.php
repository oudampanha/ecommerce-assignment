<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
  public function store(Request $request)
  {
    $validated = $request->validate([
      'products' => 'required|array',
      'products.*.product_id' => 'required|exists:products,id',
      'products.*.qty' => 'required|integer|min:1'
    ]);

    try {
      DB::beginTransaction();

      // Create the order
      $order = Order::create([
        'user_id' => auth()->id(),
        'order_date' => now()
      ]);

      $orderDetails = [];

      foreach ($validated['products'] as $productData) {
        $product = Product::findOrFail($productData['product_id']);

        if ($product->qty < $productData['qty']) {
          return response()->json([
            'status' => 'error',
            'message' => "Insufficient quantity for product ID {$productData['product_id']}"
          ], 400);
        }

        $orderDetails[] = new OrderDetails([
          'product_id' => $productData['product_id'],
          'qty' => $productData['qty']
        ]);

        $product->decrement('qty', $productData['qty']);
      }

      $order->orderDetails()->saveMany($orderDetails);

      DB::commit();

      return response()->json([
        'status' => 'success',
        'message' => 'Order placed successfully',
        'order' => $order->load('orderDetails.product')
      ], 201);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'status' => 'error',
        'message' => 'Failed to place order',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function index()
  {
    $orders = Order::with('orderDetails.product')
      ->latest()
      ->paginate(10);

    return response()->json([
      'status' => 'success',
      'orders' => $orders
    ]);
  }

  public function show(Order $order)
  {
    return response()->json([
      'status' => 'success',
      'order' => $order->load('orderDetails.product')
    ]);
  }

  public function update(Request $request, Order $order)
  {
    $validated = $request->validate([
      'order_date' => 'sometimes|date',
      'products' => 'sometimes|array',
      'products.*.product_id' => 'required_with:products|exists:products,id',
      'products.*.qty' => 'required_with:products|integer|min:1'
    ]);

    try {
      DB::beginTransaction();

      if (isset($validated['order_date'])) {
        $order->update(['order_date' => $validated['order_date']]);
      }

      if (isset($validated['products'])) {
        $order->orderDetails()->delete();

        $orderDetails = [];

        foreach ($validated['products'] as $productData) {
          $product = Product::findOrFail($productData['product_id']);

          if ($product->qty < $productData['qty']) {
            return response()->json([
              'status' => 'error',
              'message' => "Insufficient quantity for product ID {$productData['product_id']}"
            ], 400);
          }

          $orderDetails[] = new OrderDetails([
            'product_id' => $productData['product_id'],
            'qty' => $productData['qty']
          ]);

          $product->decrement('qty', $productData['qty']);
        }

        $order->orderDetails()->saveMany($orderDetails);
      }

      DB::commit();

      return response()->json([
        'status' => 'success',
        'message' => 'Order updated successfully',
        'order' => $order->load('orderDetails.product')
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'status' => 'error',
        'message' => 'Failed to update order',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function destroy(Order $order)
  {
    try {
      DB::beginTransaction();

      // Restore product quantities
      foreach ($order->orderDetails as $detail) {
        $product = Product::findOrFail($detail->product_id);
        $product->increment('qty', $detail->qty);
      }

      $order->orderDetails()->delete();
      $order->delete();

      DB::commit();

      return response()->json([
        'status' => 'success',
        'message' => 'Order deleted successfully'
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'status' => 'error',
        'message' => 'Failed to delete order',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
