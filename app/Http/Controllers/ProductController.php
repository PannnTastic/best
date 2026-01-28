<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['pictures', 'category']);

        // Filter by Category
        if ($request->has('category') && $request->category != null) {
            $query->where('category_id', $request->category);
        }

        // Search feature (Optional but good to have)
        if ($request->has('search') && $request->search != null) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('nama_produk', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('nama_produk', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest(); // Default sorting
                    break;
            }
        } else {
            $query->latest(); // Default if no sort param
        }

        $products = $query->paginate(12)->withQueryString(); // withQueryString agar paginasi tetap membawa parameter filter/sort

        $categories = \App\Models\Category::all();

        return view('products.index', compact('products', 'categories'));
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
