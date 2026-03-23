<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RefundRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Request a return for an order.
     * Only allowed when the order has not yet been returned, refunded, or cancelled.
     */
    public function requestReturn($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Please log in first'], 401);
        }

        $query = Order::where('id', $id);
        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }
        $order = $query->with('items.product')->firstOrFail();

        if (in_array($order->status, ['returned', 'refunded', 'cancelled'])) {
            return response()->json(['error' => 'Return cannot be requested for this order'], 400);
        }

        // Restock products with debug logging
        foreach ($order->items as $item) {
            if ($item->product) {
                \Log::info('Restocking product ID: ' . $item->product->id . ' by ' . $item->quantity);
                $item->product->increment('stock_quantity', $item->quantity);
            } else {
                \Log::warning('No product found for order item ID: ' . $item->id);
            }
        }

        $order->update(['status' => 'returned']);

        // Log the return request
        RefundRequest::create([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'type' => 'return',
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Return request submitted successfully']);
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
        $order = $query->with('items.product')->firstOrFail();

        if ($order->status === 'shipped' || $order->status === 'completed') {
            return response()->json(['error' => 'Refunds cannot be requested once the order has been shipped or completed'], 400);
        }

        if ($order->status === 'cancelled' || $order->status === 'refunded') {
            return response()->json(['error' => 'This order has already been cancelled or refunded'], 400);
        }

        // Restock products with debug logging
        foreach ($order->items as $item) {
            if ($item->product) {
                \Log::info('Restocking product ID: ' . $item->product->id . ' by ' . $item->quantity);
                $item->product->increment('stock_quantity', $item->quantity);
            } else {
                \Log::warning('No product found for order item ID: ' . $item->id);
            }
        }
        $order->update(['status' => 'refunded']);

        // Log the refund request
        RefundRequest::create([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'type' => 'refund',
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Refund request submitted successfully']);
    }

    /**
     * Display a specific order. Admins can view any order; users only their own.
     */
    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please log in to view this order');
        }

        $query = Order::with('items.product', 'user')->where('id', $id);

        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }

        $order = $query->firstOrFail();

        return view('order-detail', ['order' => $order, 'isAdmin' => auth()->user()->is_admin]);
    }

    /**
     * Display orders. Admins see all orders; regular users see only their own.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please log in to view your orders');
        }

        $isAdmin = auth()->user()->is_admin;

        $query = Order::with('items.product', 'user')
            ->orderBy('created_at', 'desc');

        if (!$isAdmin) {
            $query->where('user_id', auth()->id());
        }

        $orders = $query->get();

        return view('orders', ['orders' => $orders, 'isAdmin' => $isAdmin]);
    }

    /**
     * Display the current user's orders.
     */
    public function myOrders()
    {
        $orders = Order::with('items.product', 'user')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        $isAdmin = false;
        return view('orders', ['orders' => $orders, 'isAdmin' => $isAdmin]);
    }
}
