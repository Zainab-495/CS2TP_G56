<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form with featured products.
     */
    public function showLogin()
    {
        $products = Product::limit(6)->get();
        return view('login', ['products' => $products]);
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $redirect = Auth::user()->is_admin
                ? route('admin.dashboard')
                : $request->input('redirect', route('products.index'));

            return response()->json([
                'success' => true,
                'message' => 'Logged in successfully',
                'redirect' => $redirect,
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => 'Invalid email or password',
        ], 401);
    }

    /**
     * Show the registration form with featured products.
     */
    public function showRegister()
    {
        $products = Product::limit(6)->get();
        return view('register', ['products' => $products]);
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully',
            'redirect' => route('products.index'),
        ]);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Return auth status as JSON (for JS frontend check-auth).
     */
    public function status()
    {
        if (Auth::check()) {
            return response()->json([
                'loggedIn' => true,
                'username' => Auth::user()->name,
                'is_admin' => (bool) Auth::user()->is_admin,
            ]);
        }
        return response()->json(['loggedIn' => false]);
    }

    /**
     * Return session/cart init data (for JS frontend init-session).
     */
    public function sessionInit()
    {
        $cart = session('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }
}
