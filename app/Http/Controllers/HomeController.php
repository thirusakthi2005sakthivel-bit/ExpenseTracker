<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Only active categories from DB
        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        // Only active products — max 10
        $products = Product::with('category')
            ->where('status', 'active')
            ->latest()
            ->take(10)
            ->get();

        return view('user.home.index', compact('categories', 'products'));
    }
}
