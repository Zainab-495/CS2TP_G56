<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     * Requires the user to be logged in and have items in the session cart.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please log in to proceed with checkout');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('message', 'Your cart is empty');
        }

        return view('checkout');
    }

    /**
     * Process the checkout: create order + order items from the session cart.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Please log in first'], 401);
        }

        $request->validate([
            'shipping_address' => 'required|string|min:5',
            'payment_method'   => 'required|string|in:credit_card,debit_card,paypal',
            'notes'            => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'Your cart is empty'], 400);
        }

        // Calculate total from session cart
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Create order
        $order = Order::create([
            'user_id'          => auth()->id(),
            'total_amount'     => $total,
            'status'           => 'pending',
            'payment_method'   => $request->payment_method,
            'shipping_address' => $request->shipping_address,
            'notes'            => $request->notes,
        ]);

        // Create order items, resolving product_id from the stored value or by name lookup
        foreach ($cart as $item) {
            $productId = $item['product_id'] ?? null;

            if (!$productId) {
                // Fallback: look up product by name
                $product = Product::where('name', $item['name'])->first();
                $productId = $product?->id;
            }

            if ($productId) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }
        }

        // Clear session cart
        session()->forget('cart');

        return response()->json([
            'success'  => true,
            'message'  => 'Order created successfully',
            'order_id' => $order->id,
        ]);
    }
}
