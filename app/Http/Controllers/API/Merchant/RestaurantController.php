<?php

namespace App\Http\Controllers\API\Merchant;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * Get orders for the merchant's restaurant.
     */
    public function index(Request $request)
    {
        $status = $request->get('status'); // optional filter: pending, preparing, ready, completed etc.
        $restaurantId = $request->get('restaurant_id'); // list specific restaurant orders

        $query = Order::with(['orderDetails.product', 'user', 'driver']);

        if ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

        return response()->json([
            'status' => 'success',
            'orders' => $orders
        ]);
    }

    /**
     * Change state of the order during cooking preparation lifecycle.
     */
    public function updateStatus(Order $order, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:accepted,preparing,ready_for_pickup,cancelled'
        ]);

        $status = $validated['status'];

        // Enforce logical lifecycle rules
        if ($order->status === 'delivered') {
            return response()->json([
                'status' => 'error',
                'message' => 'Delivered orders cannot have their status updated.'
            ], 400);
        }

        if ($order->status === 'cancelled') {
            return response()->json([
                'status' => 'error',
                'message' => 'Cancelled orders cannot have their status updated.'
            ], 400);
        }

        $order->update([
            'status' => $status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "Order updated successfully to '{$status}'!",
            'order' => $order->load(['orderDetails.product', 'user', 'driver'])
        ]);
    }

    /**
     * Manage restaurant outlets listing / list restaurants for setup.
     */
    public function listRestaurants()
    {
        $restaurants = Restaurant::withCount('products')->get();

        return response()->json([
            'status' => 'success',
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Create profile for a restaurant outlet.
     */
    public function storeRestaurant(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cuisine_type' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255'
        ]);

        $restaurant = Restaurant::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Restaurant registered successfully!',
            'restaurant' => $restaurant
        ], 210);
    }
}
