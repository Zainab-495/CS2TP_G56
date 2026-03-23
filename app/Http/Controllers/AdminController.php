<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the form for editing a product.
     */
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'material' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'stock_threshold' => 'required|integer|min:0',
        ]);
        $product->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    public function dashboard()
    {
        $totalOrders   = Order::count();
        $totalProducts = Product::count();
        $totalUsers    = User::where('is_admin', false)->count();
        $recentOrders  = Order::with('user')->orderBy('created_at', 'desc')->limit(10)->get();

        // Get products that are out of stock or below threshold
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'stock_threshold')->get();

        $recentRefundRequests = \App\Models\RefundRequest::with('order', 'user')->orderBy('created_at', 'desc')->limit(10)->get();
        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalUsers', 'recentOrders', 'lowStockProducts', 'recentRefundRequests'));
    }

    public function orders(Request $request)
    {
        $query = Order::with('user', 'items.product')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%"))
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20)->withQueryString();
        $statuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled', 'refunded'];

        return view('admin.orders', compact('orders', 'statuses'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,processing,shipped,completed,cancelled,refunded']);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', "Order #{$id} status updated to {$request->status}.");
    }
    /**
     * Dismiss the low stock alert for the session.
     */
    public function dismissLowStockAlert()
    {
        session(['dismiss_low_stock_alert' => true]);
        return response()->json(['success' => true]);
    }
}
