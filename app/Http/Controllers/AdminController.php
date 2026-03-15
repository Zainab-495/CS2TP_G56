<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

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
}
