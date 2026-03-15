<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function data()
    {
        $cart = session('cart', []);
        $items = array_values($cart);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $items));
        return response()->json(['items' => $items, 'total' => $total]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'quantity'    => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
        ]);

        $cart = session('cart', []);
        $key  = $request->productName;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += (int) $request->quantity;
        } else {
            $cart[$key] = [
                'cart_id'    => uniqid(),
                'product_id' => $request->input('productId') ? (int) $request->productId : null,
                'name'       => $request->productName,
                'price'      => (float) $request->price,
                'quantity'   => (int) $request->quantity,
                'image'      => '/images/' . strtolower(str_replace(' ', '-', $request->productName)) . '.jpg',
                'subtotal'   => (float) $request->price * $request->quantity,
            ];
        }

        foreach ($cart as &$item) {
            $item['subtotal'] = $item['price'] * $item['quantity'];
        }

        session(['cart' => $cart]);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'index'    => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);
        $keys = array_keys($cart);

        if (!isset($keys[$request->index])) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $key = $keys[$request->index];
        $cart[$key]['quantity'] = (int) $request->quantity;
        $cart[$key]['subtotal'] = $cart[$key]['price'] * $request->quantity;

        session(['cart' => $cart]);
        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $cart = session('cart', []);
        $keys = array_keys($cart);

        $index  = $request->input('index');
        $cartId = $request->input('cartId');

        if ($index !== null && isset($keys[(int)$index])) {
            unset($cart[$keys[(int)$index]]);
        } elseif ($cartId) {
            foreach ($cart as $key => $item) {
                if ($item['cart_id'] === $cartId) { unset($cart[$key]); break; }
            }
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }

        session(['cart' => $cart]);
        return response()->json(['success' => true]);
    }

    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    public function placeOrder()
    {
        session()->forget('cart');
        return response()->json(['success' => true, 'order_id' => time()]);
    }
}
