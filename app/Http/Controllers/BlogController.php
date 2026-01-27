<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.detail', compact('blog'));
    }
}
