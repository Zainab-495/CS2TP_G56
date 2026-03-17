<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders   = Order::count();
        $totalProducts = Product::count();
        $totalUsers    = User::where('is_admin', false)->count();
        $recentOrders  = Order::with('user')->orderBy('created_at', 'desc')->limit(10)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalUsers', 'recentOrders'));
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
}
