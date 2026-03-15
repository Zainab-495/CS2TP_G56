<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display orders. Admins see all orders; regular users see only their own.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please log in to view your orders');
        }

        $isAdmin = auth()->user()->is_admin;

        $query = Order::with('orderItems.product', 'user')
            ->orderBy('created_at', 'desc');

        if (!$isAdmin) {
            $query->where('user_id', auth()->id());
        }

        $orders = $query->get();

        return view('orders', ['orders' => $orders, 'isAdmin' => $isAdmin]);
    }

    /**
     * Display a specific order. Admins can view any order; users only their own.
     */
    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please log in to view this order');
        }

        $query = Order::with('orderItems.product', 'user')->where('id', $id);

        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }

        $order = $query->firstOrFail();

        return view('order-detail', ['order' => $order, 'isAdmin' => auth()->user()->is_admin]);
    }

    /**
     * Cancel an order.
     */
    public function cancel($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Please log in first'], 401);
        }

        $query = Order::where('id', $id);
        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }
        $order = $query->firstOrFail();

        if ($order->status === 'completed' || $order->status === 'cancelled') {
            return response()->json(['error' => 'Cannot cancel this order'], 400);
        }

        $order->update(['status' => 'cancelled']);

        return response()->json(['success' => true, 'message' => 'Order cancelled successfully']);
    }

    /**
     * Request a refund for an order.
     * Only allowed when the order has not yet been shipped or completed.
     */
    public function refund($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Please log in first'], 401);
        }

        $query = Order::where('id', $id);
        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }
        $order = $query->firstOrFail();

        if ($order->status === 'shipped' || $order->status === 'completed') {
            return response()->json(['error' => 'Refunds cannot be requested once the order has been shipped or completed'], 400);
        }

        if ($order->status === 'cancelled' || $order->status === 'refunded') {
            return response()->json(['error' => 'This order has already been cancelled or refunded'], 400);
        }

        $order->update(['status' => 'refunded']);

        return response()->json(['success' => true, 'message' => 'Refund request submitted successfully']);
    }
}
