<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        $products = Product::all();
        return view('products', ['products' => $products]);
    }
    

    /**
     * Display a specific product.
     */
    public function show($id)
    {
        $product = Product::with(['reviews.user'])->findOrFail($id);
        return view('product', ['product' => $product]);
    }

    /**
     * Get products by category.
     */
    public function byCategory($category)
    {
        $products = Product::where('category', $category)->get();
        return view('products', ['products' => $products, 'category' => $category]);
    }
}
