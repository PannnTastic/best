<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with best selling products and latest blogs.
     */
    public function index()
    {
        // Ambil 8 produk untuk ditampilkan (bisa disesuaikan logicnya, misal random atau latest)
        $products = Product::with('pictures')->take(8)->get();

        // Ambil 3 blog terbaru
        $blogs = Blog::latest()->take(3)->get();

        $pictures = Picture::take(3)->get();

        return view('home', compact('products', 'blogs', 'pictures'));
    }
}
