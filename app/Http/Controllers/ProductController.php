<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        // Pagination 12 produk per halaman
        $products = Product::with(['pictures', 'category'])->paginate(12);

        return view('products.index', compact('products'));
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        // Eager load pictures dan category
        $product = Product::with(['pictures', 'category'])->findOrFail($id);

        return view('products.detail', compact('product'));
    }
}
