<?php

namespace App\Http\Controllers\API\Delivery;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    /**
     * Get orders ready for pickup by drivers.
     */
    public function availableOrders()
    {
        $orders = Order::with(['orderDetails.product', 'restaurant', 'user'])
            ->where('status', 'ready_for_pickup')
            ->whereNull('driver_id')
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'orders' => $orders
        ]);
    }

    /**
     * Driver accepts an order for delivery.
     */
    public function acceptOrder(Order $order)
    {
        if ($order->driver_id !== null) {
            return response()->json([
                'status' => 'error',
                'message' => 'This order has already been assigned or accepted by another driver.'
            ], 400);
        }

        if ($order->status !== 'ready_for_pickup' && $order->status !== 'accepted') {
            return response()->json([
                'status' => 'error',
                'message' => 'Order is not ready for pickup.'
            ], 400);
        }

        $order->update([
            'driver_id' => Auth::id(),
            'status' => 'out_for_delivery' // transition to out for delivery status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order accepted successfully. Keep safe on the road!',
            'order' => $order->load(['orderDetails.product', 'restaurant', 'user'])
        ]);
    }

    /**
     * Check active and past deliveries for the authenticated driver.
     */
    public function myDeliveries(Request $request)
    {
        $status = $request->get('status', 'active'); // 'active' or 'completed'

        $query = Order::with(['orderDetails.product', 'restaurant', 'user'])
            ->where('driver_id', Auth::id());

        if ($status === 'completed') {
            $query->where('status', 'delivered');
        } else {
            $query->whereIn('status', ['out_for_delivery', 'preparing']); // driving or preparing stages
        }

        $orders = $query->latest()->get();

        return response()->json([
            'status' => 'success',
            'orders' => $orders
        ]);
    }

    /**
     * Complete the delivery / Handover to customer.
     */
    public function completeOrder(Order $order)
    {
        if ($order->driver_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized action. This order is not assigned to you.'
            ], 403);
        }

        if ($order->status !== 'out_for_delivery') {
            return response()->json([
                'status' => 'error',
                'message' => 'Order must be out for delivery to mark as completed.'
            ], 400);
        }

        $updateData = [
            'status' => 'delivered'
        ];

        // Cash on delivery payment updates
        if ($order->payment_method === 'cod') {
            $updateData['payment_status'] = 'paid';
        }

        $order->update($updateData);

        return response()->json([
            'status' => 'success',
            'message' => 'Order successfully marked as delivered. Good job!',
            'order' => $order->load(['orderDetails.product', 'restaurant', 'user'])
        ]);
    }
}
